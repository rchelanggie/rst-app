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

app = Flask(__name__)
api = Api(app)
    
def method_there(df):
    def preprocessing(text):
        text = text.lower()
        text = text.translate(str.maketrans('', '', string.punctuation))
        text = re.sub(r'\d+', '', text)
        
        stop_words = set(stopwords.words('english'))
        word_tokens = word_tokenize(text)
        filtered_text = [word for word in word_tokens if word not in stop_words]
        
        ps = PorterStemmer()
        stemmed_text = [ps.stem(word) for word in filtered_text]
        
        lemmatizer = WordNetLemmatizer()
        lemmatized_text = [lemmatizer.lemmatize(word) for word in stemmed_text]
        
        return ' '.join(lemmatized_text)

    if 'Sentiment' in df.columns:
        df.dropna(subset=['Body'], inplace=True)
        df['Body'] = df['Body'].apply(preprocessing)

        vectorizer = TfidfVectorizer(max_features=5000)
        X = vectorizer.fit_transform(df['Body'])
        y = df['Sentiment']

        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

        sgd_model = SGDClassifier(loss="hinge", penalty="l2", max_iter=1000)
        sgd_model.fit(X_train, y_train)

        joblib.dump(vectorizer, 'tfidf_vectorizer_there.pkl')
        joblib.dump(sgd_model, 'sgd_model_there.pkl')
    else:
        df['Body'] = df['Body'].apply(preprocessing)

    def predict_new_data(new_data):
        vectorizer = joblib.load('tfidf_vectorizer_there.pkl')
        sgd_model = joblib.load('sgd_model_there.pkl')
        
        new_data['Body'] = new_data['Body'].apply(preprocessing)
        transformed_data = vectorizer.transform(new_data['Body'])
        predictions = sgd_model.predict(transformed_data)
        
        new_data['Predicted_Sentiment'] = predictions
        # if 'Quality' in new_data.columns:
        sentiment_counts = new_data.groupby('Quality')['Predicted_Sentiment'].value_counts().unstack(fill_value=0)
        return sentiment_counts
        # else:
        #     return new_data[['Body', 'Predicted_Sentiment']]

    # if 'Sentiment' not in df.columns:
    return predict_new_data(df)

    # return df

def method_ipul(df):
    def preprocessing(text):
        # Case folding
        text = text.lower()

        # Menghapus spasi berlebih
        text = re.sub(r'\s+', ' ', text).strip()

        # Menghapus angka
        text = re.sub(r'\d+', '', text)

        # Tokenisasi
        word_tokens = word_tokenize(text)

        # Stemming
        ps = PorterStemmer()
        stemmed_text = [ps.stem(word) for word in word_tokens]

        # Lemmatization (opsional)
        lemmatizer = WordNetLemmatizer()
        lemmatized_text = [lemmatizer.lemmatize(word) for word in stemmed_text]

        return ' '.join(stemmed_text)

    def preprocess_train_save_model(df):
        # Preprocessing
        df['Body'] = df['Body'].apply(preprocessing)

        # Label Encoding
        # Inisialisasi LabelEncoder
        label_encoder = LabelEncoder()

        # Fit dan transform kolom sentimen
        df['Sentiment'] = label_encoder.fit_transform(df['Sentiment'])

        # Pisahkan fitur dan label
        X = df['Body']
        y = df['Sentiment']

        # Bagi data menjadi training dan testing set
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

        # Inisialisasi TF-IDF Vectorizer
        tfidf_vectorizer = TfidfVectorizer()

        X_train = tfidf_vectorizer.fit_transform(X_train)
        X_test = tfidf_vectorizer.transform(X_test)

        # Handling Imbalance dengan SMOTE
        smote = SMOTE(random_state=0)
        X_train, y_train = smote.fit_resample(X_train, y_train)

        # Melatih model SVM
        svm_model = SVC()
        svm_model.fit(X_train, y_train)

        # Simpan objek TF-IDF ke dalam PKL
        joblib.dump(tfidf_vectorizer, 'tfidf_ipul_vectorizer.pkl')

        # Simpan model SVM ke dalam PKL
        joblib.dump(svm_model, 'sentiment_analysis_model_ipul.pkl')

        return label_encoder
    
    # Fungsi untuk melakukan prediksi pada dataset baru tanpa label
    def predict_new_data(new_data, label_encoder):
        tfidf_vectorizer = joblib.load('tfidf_ipul_vectorizer.pkl')
        svm_model = joblib.load('sentiment_analysis_model_ipul.pkl')

        # Preprocessing data baru
        new_data['Body'] = new_data['Body'].apply(preprocessing)
        
        # Transformasi TF-IDF Vectorizer
        transformed_data = tfidf_vectorizer.transform(new_data['Body'])

        # Prediksi dengan model SVM
        predictions = svm_model.predict(transformed_data)

        # Mengembalikan label prediksi ke dalam label asli
        predicted_labels = label_encoder.inverse_transform(predictions)

        predicted_df = new_data.copy()
        predicted_df['Sentiment'] = predicted_labels
        sentiment_counts = predicted_df.groupby('Quality')['Sentiment'].value_counts().unstack(fill_value=0)

        return sentiment_counts
    
    url = 'https://drive.google.com/uc?id=1vmt87QRaQuNUHbtDHbPplplnFZM-OYCG'
    # Memuat dataset CSV ke dalam DataFrame
    dataset = pd.read_csv(url)
    # Preprocessing, training model, dan menyimpan ke dalam PKL
    label_encoder = preprocess_train_save_model(dataset)

    sentiment_counts = predict_new_data(df, label_encoder)
    return sentiment_counts

def method_rachel(df):
    def preprocessing(text):
        # Case Folding
        text = text.lower()

        # Hapus Tanda Baca
        text = text.translate(str.maketrans('', '', string.punctuation))

        # Hapus Angka
        text = re.sub(r'\d+', '', text)

        # Tokenisasi
        word_tokens = word_tokenize(text)

        # Hapus Stopwords
        stop_words = set(stopwords.words('english'))
        filtered_text = [word for word in word_tokens if word not in stop_words]

        # Stemming
        ps = PorterStemmer()
        stemmed_text = [ps.stem(word) for word in filtered_text]

        # Lemmatization (opsional)
        lemmatizer = WordNetLemmatizer()
        lemmatized_text = [lemmatizer.lemmatize(word) for word in stemmed_text]

        return ' '.join(lemmatized_text)

    def vector_train_model(df):
        # Missing Values
        df.dropna(subset=['Body'], inplace=True)
        # Preprocessing
        df['Body'] = df['Body'].apply(preprocessing)

        # Label Encoding
        # Inisialisasi LabelEncoder
        label_encoder = LabelEncoder()

        # Fit dan transform kolom sentimen
        df['Sentiment'] = label_encoder.fit_transform(df['Sentiment'])

        # TF-IDF dan fiturnya
        vectorizer = TfidfVectorizer(max_features=5000)
        X = vectorizer.fit_transform(df['Body'])
        y = df['Sentiment']

        # Melatih RF Model
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=0)
        rf_model = RandomForestClassifier(n_estimators=100, random_state=42)
        rf_model.fit(X_train, y_train)

        # Save vector and model
        joblib.dump(vectorizer, 'rf_tfidf_vector.pkl')
        joblib.dump(rf_model, 'rf_model.pkl')

        return label_encoder

    def predict_new_data(new_data, label_encoder):
        # Load previous vector and model
        vectorizer = joblib.load('rf_tfidf_vector.pkl')
        rf_model = joblib.load('rf_model.pkl')

        # Processing new data
        new_data['Body'] = new_data['Body'].apply(preprocessing)
    
        # Transform new data, from 'Body'
        transformed_data = vectorizer.transform(new_data['Body'])

        # Predict new data
        predictions = rf_model.predict(transformed_data)

        # Mengembalikan label prediksi ke dalam label asli
        predicted_labels = label_encoder.inverse_transform(predictions)

        predicted_df = new_data.copy()
        predicted_df['Sentiment'] = predicted_labels
        sentiment_counts = predicted_df.groupby('Quality')['Sentiment'].value_counts().unstack(fill_value=0)

        return sentiment_counts
    
    url = 'https://drive.google.com/uc?id=1P8qGzZi979_TbIxhGyzxWl9nzGRgFRhJ'
    # Memuat dataset CSV ke dalam DataFrame
    dataset = pd.read_csv(url)
    # Preprocessing, training model, dan menyimpan ke dalam PKL
    label_encoder = vector_train_model(dataset)

    sentiment_counts = predict_new_data(df, label_encoder)
    return sentiment_counts

def process_data1(df):
    sentiment_counts = method_rachel(df)
    return {
        'method': 'ProcessData1',
        'sentiment_counts': sentiment_counts.to_dict()
    }

def process_data2(df):
    sentiment_counts = method_ipul(df)
    print(sentiment_counts.to_dict())
    return {
        'method': 'ProcessData2',
        'sentiment_counts': sentiment_counts.to_dict()
    }

def process_data3(df):
    sentiment_counts = method_there(df)
    print(sentiment_counts.to_dict())
    return {
        'method': 'ProcessData3',
        'sentiment_counts': sentiment_counts.to_dict()
    }

class MainProcessData(Resource):
    def post(self):
        metode_id = request.form.get('metode_id')
        print(f"{type(metode_id)}")
        file = request.files.get('file')
        if not file or file.filename == '':
            return jsonify({"error": "No selected file"}), 400

        df = pd.read_csv(file)

        if metode_id == '1':
            result = process_data1(df)
        elif metode_id == '2':
            result = process_data2(df)
        elif metode_id == '3':
            result = process_data3(df)
        # elif condition == 'condition3':
        #     result = process_data3(df)
        else:
            return jsonify({"error": "Invalid condition"}), 400

        return jsonify(result)

api.add_resource(MainProcessData, '/process')

if __name__ == '__main__':
    app.run(debug=True)
