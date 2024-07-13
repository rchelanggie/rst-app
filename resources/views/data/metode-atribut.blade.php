@extends('layout.two-frame')

@section('content')
<div id="main" class="container">
    <div class="content ml-5">
            <h2 style="color: #001F3F; font-size: 3rem;">Pemilihan Metode dan Atribut</h2>
            <form id="form-data" action="{{ route('metode-update') }}" method="post">
                @csrf
                <div class="card" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; width: 100%;">
                    <div class="form-group" style="width: 100%">
                        <label class="@error('metode') is-invalid @enderror"
                            style="color:#001F3F; font-size:1.2rem; font-weight:500">Metode</label>
                        @error('metode')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <select class="form-control" name="metode_id" id="metode_id"
                            style="background-color: #FFFFFF; border: 1px solid #D1D1D1; border-radius: 5px;">
                            @foreach ($metode as $m)
                                <option value="{{ $m->id }}">{{ $m->metode }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="card" style="background-color: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px; width: 100%; margin-top: 20px">
                    <div class="form-group" style="width: 100%">
                        <label class="@error('atribut') is-invalid @enderror"
                            style="color:#001F3F; font-size:1.2rem; font-weight:500">Atribut</label>
                        @error('atribut')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <select class="form-control" id="option_id" name="option_id" onchange="updateDescription()"
                            style="background-color: #FFFFFF; border: 1px solid #D1D1D1; border-radius: 5px;">
                            <option value="1">Compatibility, Portability, dan Maintainability</option>
                            <option value="2">Performance Efficiency, Security, dan Reliability</option>
                            <option value="3">Functional Suitability dan Usability</option>
                            <option value="4">All attribute</option>
                        </select>
                        <div id="description" style="margin-top: 20px; color: #001F3F; font-size: 1rem;"></div>
                    </div>
                    <br />
                    <div class="submit-btn" style="text-align: right;">
                        <button type="submit" class="btn btn-primary"
                            style="background-color: #00c96b; border-color: #00c96b; border-radius: 50px; padding: 15px 50px;">Selanjutnya
                            →</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const atributDescriptions = @json($atributDescriptions);

    function updateDescription() {
        const descriptions = {
            '1': `<div>
                            <h4>Compatibility</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Compatibility']}</p>
                            <h4>Portability</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Portability']}</p>
                            <h4>Maintainability</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Maintainability']}</p>
                        </div>`,
            '2': `<div>
                            <h4>Performance Efficiency</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Performance Efficiency']}</p>
                            <h4>Security</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Security']}</p>
                            <h4>Reliability</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Reliability']}</p>
                        </div>`,
            '3': `<div>
                            <h4>Functional Suitability</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Functional Suitability']}</p>
                            <h4>Usability</h4>
                            <hr class="custom-hr"/>
                            <p>${atributDescriptions['Usability']}</p>
                        </div>`,
            '4': `<div>
                        <h4>Compatibility</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Compatibility']}</p>
                        <h4>Portability</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Portability']}</p>
                        <h4>Maintainability</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Maintainability']}</p>
                        <h4>Performance Efficiency</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Performance Efficiency']}</p>
                        <h4>Security</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Security']}</p>
                        <h4>Reliability</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Reliability']}</p>
                        <h4>Functional Suitability</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Functional Suitability']}</p>
                        <h4>Usability</h4>
                        <hr class="custom-hr"/>
                        <p>${atributDescriptions['Usability']}</p>
                    </div>`
        };

        const select = document.getElementById('option_id');
        const descriptionDiv = document.getElementById('description');
        const selectedValue = select.value;

        descriptionDiv.innerHTML = descriptions[selectedValue];
    }

    // Initialize description on page load
    document.addEventListener('DOMContentLoaded', (event) => {
        updateDescription();
    });
</script>
@endsection