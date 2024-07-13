@extends('layout.two-frame')

@section('content-center')
    <div id="main" class="container-fluid">
        <div class="content text-center">
            <h2 style="color: #001F3F; font-size: 3rem;">Pengunggahan File User Review</h2>

            <div class="upload-form" style="margin: 50px auto; width: 50%;">
                <form id="upload-form" action="{{ route('file.upload.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="file" class="form-label" style="color: #001F3F; font-size: 1.5rem; font-weight:500">
                            Unggah File User Review
                        </label>
                        <div class="mt-2">
                            <input type="file" class="form-control-file" id="file" name="file" required
                                style="display: none;">
                            <label for="file" class="btn btn-secondary"
                                style="display: inline-block; cursor: pointer; color:#001F3F; background-color: white; border: 0px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 10px 20px; font-weight: bold; font-size:1.3rem;">
                                <img src="{{ asset('images/upload.png') }}" alt="upload icon" width="50" height="50"
                                    style="margin-right: 10px;">
                                Pilih File
                            </label>
                        </div>
                    </div>
                    <button id="submit-btn" type="submit" class="btn btn-primary mt-5"
                        style="border-radius: 50px; font-size: 1.2rem; padding-left: 50px; padding-right:50px">
                        <span style="margin-right: 10px"> Mulai Penilaian Kualitas Perangkat Lunak </span>
                        <img src="{{ asset('images/arrow-next.png') }}" alt="right arrow" width="30" height="30">
                    </button>
                </form>
            </div>

            <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true"
                style="border-radius: 50px">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <img id="modal-image" src="" width="120px" height="120px" alt="Status Image">
                            <h2 id="modal-title"></h2>
                            <p id="modal-message"></p>
                            <button type="button" class="btn btn-primary"
                                style="background-color: #C1E2FB; color:#001F3F; border-radius:30px; padding-right:70px; padding-left:70px; border:0cm; padding-top:10px; padding-bottom:10px"
                                data-dismiss="modal">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="loadingOverlay"
                style="display: none; 
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-color: rgba(119, 118, 118, 0.514);
                        justify-content: center;
                        align-items: center;
                        z-index: 9999;
                        flex-direction: column;">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="sr-only">Loading...</span>
                </div>
                <h2>Processing...</h2>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('file').addEventListener('change', function() {
            const file = this.files[0];
            if (file && file.type !== 'text/csv') {
                showModal('error', 'Error!', 'File yang dipilih harus berupa file CSV.');
                // this.value = '';  
            } else if (file) {
                showModal('success', 'File Selected', 'File user reviewmu siap untuk diunggah.');
            }
        });

        document.getElementById('submit-btn').addEventListener('click', function(event) {
            const fileInput = document.getElementById('file');
            if (!fileInput.files.length) {
                event.preventDefault();
                showModal('error', 'Error!', 'Silakan pilih file CSV untuk diunggah.');
            } else if (fileInput.files[0].type !== 'text/csv') {
                event.preventDefault();
                showModal('error', 'Error!', 'File yang dipilih harus berupa file CSV.');
            } else {
                showLoadingOverlay();
            }
        });

        function showModal(type, title, message) {
            const modal = $('#statusModal');
            const modalImage = modal.find('#modal-image');
            const modalTitle = modal.find('#modal-title');
            const modalMessage = modal.find('#modal-message');

            if (type === 'success') {
                modalImage.attr('src', '{{ asset('images/IconBerhasil.png') }}');
            } else {
                modalImage.attr('src', '{{ asset('images/IconGagal.png') }}');
            }

            modalTitle.text(title);
            modalMessage.text(message);
            modal.modal('show');
        }

        // document.getElementById('submit-btn').addEventListener('click', function() {
        //     document.getElementById('upload-form').submit();
        // });

        function showLoadingOverlay() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }
        
        @if ($errors->any())
            var errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}';
            @endforeach
            showModal('error', 'Error!', errorMessage);
        @endif

        @if (session('error'))
            showModal('error', 'Error!', '{{ session('error') }}');
        @endif
    </script>
@endsection
