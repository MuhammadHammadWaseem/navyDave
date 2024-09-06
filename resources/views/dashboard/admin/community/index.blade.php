@extends('dashboard.layouts.master')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .main-box-navy .left-all-links ul li a.community-active,
    .main-box-navy .left-all-links ul li a:hover {
        background-color: white;
        font-weight: 600;
    }

    .main-box-navy .left-all-links ul li a.community-active span,
    .main-box-navy .left-all-links ul li a:hover span {
        background-color: #2CC374;
    }

    .main-box-navy .left-all-links ul li a.community-active span img,
    .main-box-navy .left-all-links ul li a:hover span img {
        filter: invert(0) hue-rotate(465deg) brightness(10.5);
    }

    #write-post-box {
        background-color: #f1f1f1;
        border-radius: 15px;
        padding: 20px;
    }

    #write-post-box img#uploaded-image {
        position: relative !important;
    }

    #write-post-box .img-box-with-img-icons {
        position: relative;
        width: 200px;
        height: 200px;
    }

    #write-post-box .img-box-with-img-icons .icon {
        position: absolute;
        right: 0 !important;
        background-color: #ffffff !important;
        border-radius: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 25px;
        height: 25px;
        top: 5px !important;
    }

    #write-post-box .img-box-with-img-icons img {
        width: 200px;
        height: 200px;
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        margin: auto;
        object-fit: cover;
    }

    .shadow-box .large-input-box textarea {
        background-color: #F1F1F1;
        width: 100%;
        padding: 20px;
        border-radius: 10px;
        height: 100px;
        padding-left: 20px;
        border: 1px solid #0000003b;
    }
</style>
@section('content')
    <div class="col-lg-10">
        <div class="main-calendar-box main-calendar-box-list customers-box">
            <h5> Community Feeds</h5>
            <div class="shadow-box">
                <div class="three-link-align">
                    <div class="box">
                        <button id="write-post"> <img src="{{ asset('assets/images/write-a-post.png') }}"
                                alt=""></button>
                    </div>
                    <div class="box">
                        <label id="upload-photo" for="file-input" style="cursor: pointer">
                            <img src="{{ asset('assets/images/upload-photo.png') }}" alt="">
                        </label>
                        <input type="file" id="file-input" class="d-none" multiple name="image" />
                    </div>
                    <div class="box">
                        <label id="upload-video" for="video-input" style="cursor: pointer">
                            <img src="{{ asset('assets/images/upload-video.png') }}" alt="">
                        </label>
                        <input type="file" id="video-input" class="d-none" multiple name="video" />
                    </div>

                    <button id="post" class="btn btn-primary">post</button>
                </div>
                <div class="large-input-box d-none" id="write-post-box">
                    <textarea placeholder="Write something here..." id="post_text" name="post_text"></textarea>
                    <div id="uploaded-images" class="d-flex flex-wrap">
                        <!-- Uploaded images will be displayed here -->
                    </div>
                </div>


            </div>

            <div class="shadow-box">
                <div class="person-box">
                    <img src="assets/images/tony-stark-img.png" alt="">
                    <div class="text">
                        <div class="two-text-align">
                            <h6>Tony Stark</h6>
                            <a href="#">@tony_stark_3000</a>
                        </div>
                        <p>Looking for an amazing scientist who knows how to build a suit
                            that can fly high in the sky without any problem.</p>
                    </div>
                </div>
                <div class="input-box-three-icons">
                    <div class="large-input-box large-input-box-small ">
                        <input type="text" placeholder="Write something here...">
                        <img class="flow-img" src="{{ asset('assets/images/input-box-edit.png') }}" alt="">
                    </div>
                    <div class="three-things-align">
                        <ul>
                            <li><a href="#"><img src="{{ asset('assets/images/thums.png') }}" alt=""></a></li>
                            <li><a href="#"><img src="{{ asset('assets/images/message.png') }}" alt=""></a>
                            </li>
                            <li><a href="#"><img src="{{ asset('assets/images/back.png') }}" alt=""></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="shadow-box">
                <div class="person-box">
                    <img src="assets/images/tony-stark-img.png" alt="">
                    <div class="text">
                        <div class="two-text-align">
                            <h6>Tony Stark</h6>
                            <a href="#">@tony_stark_3000</a>
                        </div>
                        <p>Looking for an amazing scientist who knows how to build a suit
                            that can fly high in the sky without any problem.</p>
                    </div>
                </div>
                <div class="three-images-align">
                    <a href="{{ asset('assets/images/gallery-img-01.png') }}" data-fancybox="images" tabindex="0"><img
                            src="{{ asset('assets/images/gallery-img-01.png') }}" alt=""></a>
                    <a href="{{ asset('assets/images/gallery-img-02.png') }}" data-fancybox="images" tabindex="0"><img
                            src="{{ asset('assets/images/gallery-img-02.png') }}" alt=""></a>
                    <a href="{{ asset('assets/images/gallery-img-03.png') }}" data-fancybox="images" tabindex="0"><img
                            src="{{ asset('assets/images/gallery-img-03.png') }}" alt=""></a>
                </div>
                <div class="input-box-three-icons">
                    <div class="large-input-box large-input-box-small ">
                        <input type="text" placeholder="Write something here...">
                        <img class="flow-img" src="{{ asset('assets/images/input-box-edit.png') }}" alt="">
                    </div>
                    <div class="three-things-align">
                        <ul>
                            <li><a href="#"><img src="{{ asset('assets/images/thums.png') }}" alt=""></a>
                            </li>
                            <li><a href="#"><img src="{{ asset('assets/images/message.png') }}" alt=""></a>
                            </li>
                            <li><a href="#"><img src="{{ asset('assets/images/back.png') }}" alt=""></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        writepost();
        function writepost() {
            $("#write-post").click(function() {
                $("#write-post-box").toggleClass("d-block");
            });
        }

        function uploadimage() {
            // Handle file input change for multiple files
            $("#file-input").on("change", function() {
                var files = this.files;

                if (files.length > 0) {
                    // Show the #write-post-box
                    $("#write-post-box").toggleClass("d-none").addClass("d-block");

                    // Clear previously uploaded images
                    $("#uploaded-images").empty();

                    // Loop through each selected file
                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];

                        // Only process image files
                        if (file.type.startsWith('image/')) {
                            var reader = new FileReader();

                            // Closure to capture the file information
                            reader.onload = (function(file) {
                                return function(e) {
                                    // Append the uploaded image to the #uploaded-images container
                                    $("#uploaded-images").append(`
                                <div class="position-relative m-2 image-container">
                                    <div class="img-box-with-img-icons">
                                        <div class="icon remove-icon" style="top: 0.5rem; right: 0.5rem; z-index: 10; background: rgba(225, 225, 225, 0.856); cursor: pointer;">
                                            <i class="fa fa-times" data-file-name="` + file.name + `"></i>
                                        </div>
                                        <img class="flow-img" src="` + e.target.result + `" alt="Uploaded Image">
                                    </div>
                                </div>
                            `);
                                };
                            })(file);

                            // Read the image file as a data URL
                            reader.readAsDataURL(file);
                        }
                    }
                }
            });
        }
        // Remove image on clicking the delete icon
        function removeImage() {
            $("#uploaded-images").on("click", ".remove-icon", function() {
                $(this).closest(".image-container").remove();
            });
        }
        removeImage();
        uploadimage();
    });
</script> --}}
<script>
    $(document).ready(function() {
        writepost();
        uploadimage();
        removeImage();

        function writepost() {
            $("#write-post").click(function() {
                $("#write-post-box").toggleClass("d-block");
            });
        }

        function uploadimage() {
            $("#file-input").on("change", function() {
                var files = this.files;

                if (files.length > 0) {
                    $("#write-post-box").toggleClass("d-none").addClass("d-block");
                    $("#uploaded-images").empty();

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];

                        if (file.type.startsWith('image/')) {
                            var reader = new FileReader();

                            reader.onload = (function(file) {
                                return function(e) {
                                    $("#uploaded-images").append(`
                                    <div class="position-relative m-2 image-container">
                                        <div class="img-box-with-img-icons">
                                            <div class="icon remove-icon" style="top: 0.5rem; right: 0.5rem; z-index: 10; background: rgba(225, 225, 225, 0.856); cursor: pointer;">
                                                <i class="fa fa-times" data-file-name="` + file.name + `"></i>
                                            </div>
                                            <img class="flow-img" src="` + e.target.result + `" alt="Uploaded Image">
                                        </div>
                                    </div>
                                `);
                                };
                            })(file);

                            reader.readAsDataURL(file);
                        }
                    }
                }
            });
        }

        function removeImage() {
            $("#uploaded-images").on("click", ".remove-icon", function() {
                $(this).closest(".image-container").remove();
            });
        }

        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Include CSRF token in AJAX setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });

        // Upload Image and content
        $("#post").click(function() {
            var formData = new FormData();
            formData.append('content', $("#post_text").val());

            var imageInput = $("#file-input")[0];
            var videoInput = $("#video-input")[0];

            if (imageInput && imageInput.files) {
                var imageFiles = imageInput.files;
                for (var i = 0; i < imageFiles.length; i++) {
                    formData.append('files[]', imageFiles[i]);
                }
            }

            if (videoInput && videoInput.files) {
                var videoFiles = videoInput.files;
                for (var i = 0; i < videoFiles.length; i++) {
                    formData.append('files[]', videoFiles[i]);
                }
            }

            $.ajax({
                url: '/post',
                type: 'POST',
                data: formData, // Pass formData directly here
                contentType: false, // Let the browser set the content type
                processData: false, // Prevent jQuery from processing data
                success: function(response) {
                    alert('Post submitted successfully!');
                    $("#write-post-box").addClass("d-none");
                    $("#file-input").val('');
                    $("#video-input").val('');
                    $("#uploaded-files").empty();
                },
                error: function(xhr) {
                    alert('An error occurred while submitting the post.');
                }
            });
        });
        // End Work Upload  




    });
</script>
