import pandas as pd
import re
import string
from flask import Flask, request, jsonify
from flask_restful import Api, Resource
from nltk.corpus import stopwords
from nltk.stem import PorterStemmer
from nltk.stem import WordNetLemmatizer
from nltk.tokenize import word_tokenize
from sklearn.feature_extraction.text import TfidfVectorizer, CountVectorizer
from sklearn.ensemble import RandomForestClassifier
from sklearn.linear_model import SGDClassifier
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score, classification_report
import nltk
from imblearn.over_sampling import SMOTE, RandomOverSampler
from sklearn.svm import SVC
from sklearn.preprocessing import LabelEncoder
import joblib

nltk.download('stopwords')
nltk.download('punkt')
nltk.download('wordnet')

def method_rachel(df):
# Preprocessing
    # Missing Values
    df.dropna(subset=['Body'], inplace=True)
    
    # Case Folding
    df['Body'] = df['Body'].str.lower()

    # Hapus Tanda Baca
    def remove_punctuation(text):
        return text.translate(str.maketrans('', '', string.punctuation))
    df['Body'] = df['Body'].apply(remove_punctuation)

    # Hapus Angka
    df['Body'] = df['Body'].str.replace('\d+', '', regex=True)

    #Hapus Stopwords
    stop_words = set(stopwords.words('english'))
    def remove_stopwords(text):
        word_tokens = word_tokenize(text)
        filtered_text = [word for word in word_tokens if word not in stop_words]
        return ' '.join(filtered_text)

    df['Body'] = df['Body'].apply(remove_stopwords)

    # Stemmming = Hapus prefix dan sufix
    ps = PorterStemmer()
    def stemming(text):
        word_tokens = word_tokenize(text)
        stemmed_text = [ps.stem(word) for word in word_tokens]
        return ' '.join(stemmed_text)

    df['Body'] = df['Body'].apply(stemming)

    # Lemmatization = Ubah kata mjd bentuk dasar
    lemmatizer = WordNetLemmatizer()
    def lemmatize(text):
        word_tokens = word_tokenize(text)
        lemmatized_text = [lemmatizer.lemmatize(word) for word in word_tokens]
        return ' '.join(lemmatized_text)

    df['Body'] = df['Body'].apply(lemmatize)

    # TF-IDF dan fiturnya
    vectorizer = TfidfVectorizer(max_features=5000)
    X = vectorizer.fit_transform(df['Body'])
    y = df['Sentiment']

    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=0)
    rf_model = RandomForestClassifier(n_estimators=100, random_state=42)
    rf_model.fit(X_train, y_train)
    y_pred = rf_model.predict(X_test)

    accuracy = accuracy_score(y_test, y_pred)
    report = classification_report(y_test, y_pred, zero_division=0, output_dict=True)

    # Save vector and model
    joblib.dump(vectorizer, 'rf_tfidf_vector.pkl')
    joblib.dump(rf_model, 'rf_model.pkl')

    def predict_new_data(new_data):
        # Load previous vector and model
        vectorizer = joblib.load('rf_tfidf_vector.pkl')
        rf_model = joblib.load('rf_model.pkl')

        # Processing new data
        new_data['Body'] = new_data['Body'].str.lower()
        new_data['Body'] = new_data['Body'].apply(remove_punctuation)
        new_data['Body'] = new_data['Body'].str.replace('\d+', '', regex=True)
        new_data['Body'] = new_data['Body'].apply(remove_stopwords)
        new_data['Body'] = new_data['Body'].apply(stemming)
        new_data['Body'] = new_data['Body'].apply(lemmatize)

        # Transform new data, from 'Body'
        transformed_data = vectorizer.transform(new_data['Body'])

        # Predict new data
        predictions = rf_model.predict(transformed_data)

        new_data['Predicted_Sentiment'] = predictions
        sentiment_counts = new_data.groupby('Quality')['Predicted_Sentiment'].value_counts().unstack(fill_value=0)

        return sentiment_counts
        
    return predict_new_data(df)