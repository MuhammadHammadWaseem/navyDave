        @extends('dashboard.layouts.master')
        @section('content')
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

                #write-post-box .img-box-with-img-icons img,
                #write-post-box .img-box-with-img-icons video {
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

                .main-calendar-box.main-calendar-box-list.customers-box .two-boxes-inline {
                    display: flex;
                    column-gap: 15px;
                    align-items: flex-end;
                    flex-direction: column;
                    row-gap: 10px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box .two-boxes-inline button {
                    background-color: #3bc476;
                    border-radius: 5px;
                    border: 1px solid #3bc476;
                    transition: .3s;
                }

                .main-calendar-box.main-calendar-box-list.customers-box .two-boxes-inline button:hover {
                    background-color: black;
                    border-color: black;
                }

                .main-calendar-box.main-calendar-box-list.customers-box .three-things-align {
                    margin-bottom: 36px;
                }

                .post-slider-box .three-images-align {
                    margin: 0 !important;
                }

                .shadow-box .person-box {
                    width: 100%;
                }

                .post-slider-box {
                    position: relative;
                    width: 100%;
                    overflow: hidden;
                }

                .post-slider-imges-box {
                    width: 1000px;
                    max-width: 1000px;
                    overflow: hidden;
                    overflow-x: auto;
                    white-space: nowrap;
                    padding-bottom: 20px;
                    margin-bottom: 30px;
                }

                .post-slider-imges-box .three-images-align {
                    width: 345px;
                    display: inline-block !important;
                    max-width: 345px;
                }

                .shadow-box .person-box .text {
                    width: 100%;
                }

                .post-slider-imges-box .three-images-align img,
                .post-slider-imges-box .three-images-align video {
                    width: 300px;
                    height: 300px;
                    border: 1px solid #00000052;
                    border-radius: 10px;
                }

                /* width */
                .post-slider-imges-box::-webkit-scrollbar {
                    width: 5px;
                    height: 5px;
                }

                /* Track */
                .post-slider-imges-box::-webkit-scrollbar-track {
                    box-shadow: inset 0 0 5px grey;
                    border-radius: 10px;
                }

                /* Handle */
                .post-slider-imges-box::-webkit-scrollbar-thumb {
                    background: #2CC374;
                    border-radius: 10px;
                }

                /* Handle on hover */
                .post-slider-imges-box::-webkit-scrollbar-thumb:hover {
                    background: #000000;
                }

                .shadow-box .input-box-three-icons .large-input-box.large-input-box-small button#comment_post {
                    background-color: #3bc476;
                    border-radius: 5px;
                    border: 1px solid #3bc476;
                    transition: .3s;
                    float: right;
                    margin-top: 10px;
                }

                .shadow-box .input-box-three-icons .large-input-box.large-input-box-small button#comment_post:hover {
                    background-color: black;
                }

                .shadow-box .input-box-three-icons .large-input-box.large-input-box-small {
                    width: 80% !important;
                }

                .shadow-box .input-box-three-icons .three-things-align {
                    width: 18% !important;
                }

                .shadow-box .input-box-three-icons {
                    display: flex;
                    flex-direction: row;
                    flex-wrap: wrap;
                }

                .reply-box p {
                    display: flex;
                    flex-direction: column;
                    font-size: 14px;
                }

                .reply-box p strong {
                    font-size: 12px;
                }

                .shadow-box .large-input-box.large-input-box-small input {
                    height: 60px;
                    padding-right: 60px;
                }

                .shadow-box .input-box-three-icons .large-input-box.large-input-box-small button#comment_post {
                    position: absolute;
                    right: 10px;
                    top: 5px;
                }

                .comment-box p.d-flex.gap-3.w-100 img.mt-1 {
                    background-color: #000000;
                    width: 35px;
                    height: 35px;
                    object-fit: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: .3s;
                }

                .community-new .two-align-things {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 40px;
                    align-items: center;
                }

                .community-new .two-align-things h5 {
                    margin: 0;
                }

                .community-new .two-align-things .two-btns-inline {
                    display: flex;
                    column-gap: 20px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .main-admin-blog {}

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .main-admin-blog .detalingsread-more .content {
                    margin: 20px 0;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .main-admin-blog .detalingsread-more .content p {
                    font-size: 17px;
                    color: #888888;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .main-admin-blog .detalingsread-more .content p a.read-more-btn {
                    display: block;
                    color: #2CC374;
                    font-weight: 700;
                    transition: .3s;
                    margin: 10px 0;
                    text-decoration: underline;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .main-admin-blog .detalingsread-more .content p a.read-more-btn:hover {
                    color: black;
                }


                .btn {
                    /* Your default anchor styles here */
                    text-decoration: none;
                    color: gray;
                }

                .btn.active {
                    /* Active state styles */
                    color: black;
                }

                .community-new .two-align-things .two-btns-inline .btn {
                    background-color: #F0F0F0;
                    border-radius: 10px;
                    border: none;
                    color: #222222;
                    font-size: 20px;
                    font-weight: 500;
                    padding: 10px 20px;
                    display: flex;
                    align-items: center;
                    column-gap: 10px;
                    transition: .3s;
                }

                .community-new .two-align-things .two-btns-inline .btn svg path {
                    fill: #222222;
                    transition: .3s;
                }

                .community-new .two-align-things .two-btns-inline .btn.active {
                    background-color: #2CC374;
                    color: white;
                }

                .community-new .two-align-things .two-btns-inline .btn.active svg path {
                    fill: white;
                }

                .community-new .two-align-things .two-btns-inline .btn:hover {
                    color: white;
                    background-color: #2CC374;
                }

                .community-new .two-align-things .two-btns-inline .btn:hover svg path {
                    fill: white;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new {
                    padding: 20px 50px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box {
                    border: 1px solid #0000002b;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .input-post-inline {
                    display: flex;
                    justify-content: space-between;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .input-post-inline input {
                    width: 90%;
                    border: 1px solid #00000030;
                    background-color: #EEEEEE;
                    height: 50px;
                    padding: 20px;
                    border-radius: 50px;
                    color: #999999;
                    font-size: 17px;
                    font-weight: 500;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .input-post-inline input button {
                    color: white !important;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .input-post-inline button {
                    background-color: #2CC374;
                    color: white;
                    font-weight: 400;
                    border: none;
                    padding: 10px 40px;
                    border-radius: 10px;
                    font-size: 20px;
                    transition: .3s;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .input-post-inline button:hover {
                    background-color: black;
                    color: white;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .three-link-align .box label img {
                    width: 153px;
                    height: 24px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .three-link-align .box label {
                    margin: 0;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .three-link-align {
                    margin-bottom: 0;
                }

                .shadow-box.post-detaling .parent-person-box {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }


                .shadow-box.post-detaling .parent-person-box .person-details {
                    display: flex;
                    align-items: center;
                    column-gap: 20px;
                }

                .shadow-box.post-detaling .parent-person-box .person-details .content h6 {
                    color: #0F191A;
                    font-size: 20px;
                    font-weight: 500;
                }

                .shadow-box.post-detaling .parent-person-box .person-details .content h5 {
                    font-size: 15px;
                    color: #2CC374;
                    font-weight: 400;
                    margin: 0;
                }

                .shadow-box.post-detaling .parent-person-box .person-details-date h4 {
                    color: #777777;
                    font-size: 20px;
                }

                .more-text {
                    display: none;
                }

                .read-more-btn {
                    color: blue;
                    cursor: pointer;
                }

                .dots {
                    display: inline;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box {
                    display: flex;
                    flex-direction: row;
                    flex-wrap: nowrap;
                    overflow: scroll;
                    width: 100% !important;
                    max-width: 100% !important;
                    overflow-x: auto;
                    overflow-y: hidden;
                    gap: 30px;
                    padding-bottom: 20px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box .box.imge.video {
                    width: 310px;
                    max-width: 310px;
                    display: contents;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box .box.imge.video img,
                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box .box.imge.video video {
                    width: 310px;
                    height: 310px;
                    border-radius: 30px;
                    border: 1px solid #0000001a;
                    object-fit: cover;
                    object-position: center;
                }


                /* width */
                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box::-webkit-scrollbar {
                    width: 5px;
                    height: 5px;
                }

                /* Track */
                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box::-webkit-scrollbar-track {
                    box-shadow: inset 0 0 5px grey;
                    border-radius: 10px;
                }

                /* Handle */
                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box::-webkit-scrollbar-thumb {
                    background: #2CC374;
                    border-radius: 10px;
                }

                /* Handle on hover */
                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .scroll-full-box::-webkit-scrollbar-thumb:hover {
                    background: black;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box {
                    display: flex;
                    justify-content: space-between;
                    margin: 20px 0;
                    align-items: center;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .box.input-box {
                    width: 68%;
                    position: relative;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .box.input-box input {
                    width: 100%;
                    border: 1px solid #00000030;
                    background-color: #EEEEEE;
                    height: 50px;
                    padding: 20px;
                    border-radius: 50px;
                    color: #999999;
                    font-size: 17px;
                    font-weight: 500;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .box.input-box button {
                    position: absolute;
                    right: 10px;
                    color: white;
                    background-color: #2CC374;
                    padding: 7px 20px;
                    border-radius: 50px;
                    top: 6px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .two-btns-inline {
                    display: flex;
                    gap: 20px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .two-btns-inline .box button {
                    background-color: #F0F0F0;
                    font-size: 20px;
                    color: #222222;
                    padding: 8px 20px;
                    display: flex;
                    border-radius: 15px;
                    transition: .3s;
                    align-items: center;
                    gap: 7px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .two-btns-inline .box button:hover {
                    background-color: #2CC374;
                    color: white;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .two-btns-inline .box button:hover svg path {
                    fill: white;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .two-btns-inline .box button.liked {
                    background-color: #2CC374;
                    color: white;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .comment-input-box .two-btns-inline .box button.liked svg path {
                    fill: white;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .img-box {
                    display: flex;
                    align-items: center;
                    column-gap: 10px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .img-box .content-name h6 {
                    color: #0F191A;
                    font-size: 14px;
                    font-weight: 600;
                    margin-bottom: 3px;
                    display: flex !important;
                    align-items: center !important;
                    align-items: center !important;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .img-box .content-name h5 {
                    color: #2CC374;
                    font-size: 11px;
                    margin: 0;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .two-btns-inline {
                    display: flex;
                    gap: 20px;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .two-btns-inline button {
                    background-color: #CCCCCC;
                    padding: 5px 20px;
                    display: flex;
                    gap: 4px;
                    align-items: center;
                    color: white;
                    font-weight: 500;
                    border-radius: 10px;
                    transition: .3s;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .two-btns-inline button:hover {
                    background-color: #2cc374;
                }

                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-content .content-area-comment p {
                    margin: 20px 0;
                }

                .person-comments-section button#toggleBtn {
                    float: right;
                    margin-bottom: 0px !important;
                    margin-top: -20px;
                    background-color: #ff000000;
                    color: #2CC374;
                    font-weight: 700;
                    text-decoration: underline;
                    font-size: 17px;
                    transition: .3s;
                }

                .person-comments-section button#toggleBtn:hover {
                    color: black;
                }

                .comment-edit .modal-body form {
                    width: 100%;
                }

                .comment-edit .modal-body form textarea {
                    width: 100%;
                    height: 150px;
                    padding: 15px;
                    border-radius: 10px;
                    margin-bottom: 20px;
                }

                .comment-edit .modal-body form button {
                    background-color: #2CC374;
                    display: inline-block;
                    margin-right: 10px;
                    padding: 7px 20px;
                    border-radius: 10px;
                    border: none;
                    color: white;
                    font-size: 16px;
                    transition: .3s;
                }

                button {
                    box-shadow: none !important;
                    outline: none !important;
                    stroke: none !important;
                    border: none !important;
                }

                .comment-edit .modal-body form button:hover {
                    background-color: black;
                }

                .comment-edit .modal-body form button.btn.btn-secondary {
                    background-color: gray !important;
                }

                .shadow-box.post-detaling .parent-person-box .person-details img {
                    border-radius: 100%;
                    width: 50px;
                    height: 50px;
                    border: 2px solid #2cc374;
                }
                .main-calendar-box.main-calendar-box-list.customers-box.community-new .shadow-box .person-comment-box .img-box .img img {
        width: 40px;
        height: 40px;
        border-radius: 100%;
        border: 1px solid #00000026;
        object-fit: cover;
    }
            </style>
            <div class="col-lg-10">
                <div class="main-calendar-box main-calendar-box-list customers-box community-new ">
                    <div class="two-align-things">
                        <h5> Community Feeds</h5>

                        <div class="two-btns-inline">
                            <a href="#" class="btn active" id="popular-btn">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M6.78818 14.9198L5.2361 21.6406C5.18803 21.8441 5.20246 22.0574 5.2775 22.2526C5.35253 22.4478 5.48468 22.6158 5.65669 22.7347C5.8287 22.8536 6.03257 22.9179 6.24167 22.9191C6.45078 22.9204 6.65539 22.8585 6.8288 22.7416L12.5007 18.9604L18.1726 22.7416C18.35 22.8595 18.5592 22.9201 18.7722 22.9154C18.9851 22.9108 19.1915 22.841 19.3636 22.7155C19.5357 22.5901 19.6652 22.4149 19.7348 22.2136C19.8044 22.0123 19.8106 21.7945 19.7528 21.5896L17.8476 14.9229L22.5726 10.6708C22.7239 10.5346 22.832 10.3569 22.8834 10.1599C22.9349 9.96286 22.9274 9.75507 22.862 9.56221C22.7966 9.36936 22.6762 9.1999 22.5155 9.0748C22.3548 8.9497 22.161 8.87443 21.958 8.85831L16.0194 8.3854L13.4496 2.69686C13.3677 2.51369 13.2345 2.35814 13.0661 2.249C12.8977 2.13986 12.7013 2.08179 12.5007 2.08179C12.3 2.08179 12.1036 2.13986 11.9353 2.249C11.7669 2.35814 11.6337 2.51369 11.5517 2.69686L8.98193 8.3854L3.04339 8.85727C2.84386 8.87308 2.65311 8.94603 2.49396 9.06741C2.33482 9.18879 2.214 9.35344 2.14598 9.54168C2.07796 9.72992 2.06561 9.93377 2.11041 10.1288C2.15521 10.3239 2.25526 10.5019 2.3986 10.6416L6.78818 14.9198Z"
                                        fill="white" />
                                </svg>
                                Popular</a>
                            <a href="#" class="btn" id="hot-btn">
                                <svg width="25" height="25" viewBox="0 0 25 25" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.1875 8.33328C17.1875 9.89578 16.6667 11.9791 14.1667 12.8124C14.8958 11.0416 15 9.27078 14.4792 7.60411C13.75 5.41661 11.3542 3.74995 9.6875 2.81245C9.27083 2.49995 8.54167 2.91661 8.64583 3.54161C8.64583 4.68745 8.33333 6.35411 6.5625 8.12495C4.27083 10.4166 3.125 12.8124 3.125 15.1041C3.125 18.1249 5.20833 21.8749 9.375 21.8749C5.20833 17.7083 8.33333 14.0624 8.33333 14.0624C9.16667 20.2083 13.5417 21.8749 15.625 21.8749C17.3958 21.8749 20.8333 20.6249 20.8333 15.2083C20.8333 11.9791 19.4792 9.47911 18.3333 8.02078C18.0208 7.49995 17.2917 7.81245 17.1875 8.33328Z"
                                        fill="#222222" />
                                </svg>
                                Hot</a>
                        </div>

                    </div>

                    <div class="shadow-box">
                        <div class="input-post-inline">
                            <input type="text" placeholder="What's on your mind?">
                            <button>Post</button>
                        </div>

                        <div class="three-link-align">
                            <div class="box">
                                <label id="upload-photo" for="file-input" style="cursor: pointer">
                                    <img src="{{ asset('assets/images/upload-images.png') }}" width="100%" height="40px"
                                        alt="">
                                </label>
                                <input type="file" id="file-input" class="d-none" multiple name="image[]" />
                            </div>

                            <div class="box">
                                <label id="upload-photo" for="file-input" style="cursor: pointer">
                                    <img src="{{ asset('assets/images/upload-videos.png') }}" width="100%" height="40px"
                                        alt="">
                                </label>
                                <input type="file" id="file-input" class="d-none" multiple name="image[]" />
                            </div>

                        </div>


                    </div>

                    <div id="post-detaling">
                    </div>

                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade comment-edit" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Your Comment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editCommentForm">
                                <textarea id="editCommentInput" placeholder="Edit your comment"></textarea>
                                <input type="hidden" id="commentId" />
                                <button type="submit">Save Changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <button id="load-more" onclick="loadPosts()" class="btn btn-secondary text-center mt-3">Show More</button>


            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
            <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

            <script>
                let currentPage = 0;
                let lastPage = 0;
                const currentUserId = {{ auth()->user()->id }};
                const isAdmin = {{ auth()->user()->hasRole('admin') ? 'true' : 'false' }};



                function timeAgo(dateString) {
                    const now = new Date();
                    const past = new Date(dateString);
                    const seconds = Math.floor((now - past) / 1000);
                    const minutes = Math.floor(seconds / 60);
                    const hours = Math.floor(minutes / 60);
                    const days = Math.floor(hours / 24);

                    if (seconds < 60) return `${seconds} seconds ago`;
                    if (minutes < 60) return `${minutes} minutes ago`;
                    if (hours < 24) return `${hours} hours ago`;
                    return `${days} days ago`;
                }

                function formatCount(count) {
                    if (count >= 1000) {
                        return (count / 1000).toFixed(1) + 'K'; // e.g., 1200 becomes "1.2K"
                    }
                    return count.toString(); // Return the count as a string
                }


                function loadPosts() {
                    $.ajax({
                        url: `/post/get?page=${currentPage + 1}`,
                        type: 'GET',
                        success: function(response) {

                            console.log(response);
                            lastPage = response.last_page;

                            if (currentPage >= lastPage) {
                                document.getElementById('load-more').style.display = 'none';
                            }

                            if (response.data.length > 0) {
                                response.data.forEach(post => {

                                    let imageSection = '';
                                    let videoSection = '';
                                    let commentSection = '';
                                    let moreComments = '';

                                    // Loop through images
                                    if (post.images) {
                                        post.images.forEach(image => {
                                            imageSection += `
                                                <div class="box imge video">
                                                        <img src="{{ Storage::url('${image.path}') }}" width="100px" height="100px" alt="" >
                                                </div>
                                            `;
                                        });
                                    }

                                    // Loop through videos
                                    if (post.videos) {
                                        post.videos.forEach(video => {
                                            videoSection += `
                                                <div class="box imge video">
                                                    <video poster="{{ Storage::url('${video.path}') }}" controls preload="none">
                                                        <source src="{{ Storage::url('${video.path}') }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            `;
                                        });
                                    }

                                    // Loop through comments
                                    if (post.comments && post.comments.length > 0) {
                                        // Show the first comment
                                        let firstComment = post.comments[0];
                                        let img = firstComment.user.image;
                                        let canDeleteComment = firstComment.user_id == currentUserId || isAdmin;
                                        let canEditComment = firstComment.user_id == currentUserId;
                                        commentSection += `
                                            <div class="person-comment-content">
                                                <div class="person-comment-box">
                                                    <div class="img-box">
                                                        <div class="img">
                                                            <img ${img ? `src="{{ Storage::url('${img}') }}"` : 'src="{{ asset('assets/images/tony-stark-img.png') }}"'} width="100%" height="40px" alt="">
                                                        </div>
                                                        <div class="content-name">
                                                            <h6>${firstComment.user.name} <span style="font-size: 10px; font-weight: 400; color: #777777;">&nbsp | ${timeAgo(firstComment.created_at)}</span></h6>
                                                            <h5>${firstComment.user.email}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="two-btns-inline">
                                                        ${canEditComment ? `
                                                            <button type="button" class="btn btn-primary" data-comment-id="${firstComment.id}" data-toggle="modal"
                                                                data-target="#exampleModal"><svg width="20" height="19"
                                                                    viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M15.2451 1.63672L17.5293 3.9209L15.788 5.66297L13.5038 3.37879L15.2451 1.63672ZM6.87891 12.2871H9.16309L14.7114 6.73882L12.4272 4.45464L6.87891 10.0029V12.2871Z"
                                                                        fill="white"></path>
                                                                    <path
                                                                        d="M15.2526 14.5715H6.99758C6.97778 14.5715 6.95723 14.5791 6.93743 14.5791C6.91231 14.5791 6.88718 14.5722 6.86129 14.5715H4.5931V3.91195H9.80636L11.3291 2.38916H4.5931C3.75328 2.38916 3.07031 3.07137 3.07031 3.91195V14.5715C3.07031 15.412 3.75328 16.0942 4.5931 16.0942H15.2526C15.6565 16.0942 16.0438 15.9338 16.3294 15.6482C16.615 15.3627 16.7754 14.9753 16.7754 14.5715V7.9717L15.2526 9.49449V14.5715Z"
                                                                        fill="white"></path>
                                                                </svg>
                                                                Edit</button> ` : ''}
                                                        ${canDeleteComment ? `
                                                                <button type="button" class="delete-comment" data-comment-id="${firstComment.id}"><svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M4.3154 15.331C4.3154 15.7348 4.4758 16.1221 4.76131 16.4076C5.04682 16.6931 5.43406 16.8535 5.83784 16.8535H13.45C13.8538 16.8535 14.241 16.6931 14.5265 16.4076C14.812 16.1221 14.9724 15.7348 14.9724 15.331V6.19645H16.4949V4.67402H13.45V3.15158C13.45 2.74781 13.2896 2.36057 13.0041 2.07506C12.7186 1.78955 12.3313 1.62915 11.9276 1.62915H7.36027C6.95649 1.62915 6.56926 1.78955 6.28375 2.07506C5.99823 2.36057 5.83784 2.74781 5.83784 3.15158V4.67402H2.79297V6.19645H4.3154V15.331ZM7.36027 3.15158H11.9276V4.67402H7.36027V3.15158ZM6.59905 6.19645H13.45V15.331H5.83784V6.19645H6.59905Z"
                                                                            fill="white"></path>
                                                                        <path
                                                                            d="M7.35938 7.71899H8.88181V13.8087H7.35938V7.71899ZM10.4042 7.71899H11.9267V13.8087H10.4042V7.71899Z"
                                                                            fill="white"></path>
                                                                    </svg>
                                                                    Delete</button>` : ''}
                                                    </div>
                                                </div>
                                                <div class="content-area-comment">
                                                    <p>${firstComment.comment}</p>
                                                </div>
                                            </div>
                                            `;

                                        // Prepare the rest of the comments, but keep them hidden initially
                                        if (post.comments.length > 1) {
                                            moreComments += `<div class="more-comments" style="display:none;">`;
                                            post.comments.slice(1).forEach(comment => {
                                                let canDeleteComment = comment.user.id ==
                                                    currentUserId || isAdmin;
                                                let canEditComment = comment.user.id == currentUserId;
                                                let img = comment.user.image;
                                                moreComments += `
                                                    <div class="person-comment-content">
                                                        <div class="person-comment-box">
                                                            <div class="img-box">
                                                                <div class="img">
                                                                    <img ${img ? `src="{{ Storage::url('${img}') }}"` : 'src="{{ asset('assets/images/tony-stark-img.png') }}"'} width="100%" height="40px" alt="">
                                                                </div>
                                                                <div class="content-name">
                                                                    <h6>${comment.user.name} <span style="font-size: 10px; font-weight: 400; color: #777777;">&nbsp | ${timeAgo(comment.created_at)}</span></h6>
                                                                    <h5>${comment.user.email}</h5>
                                                                </div>
                                                            </div>
                                                            <div class="two-btns-inline">
                                                                ${canEditComment ? `
                                                                                                                                                                        <button type="button" class="btn btn-primary" data-comment-id="${comment.id}" data-toggle="modal"
                                                                                                                                                                            data-target="#exampleModal"><svg width="20" height="19"
                                                                                                                                                                                viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                                                <path
                                                                                                                                                                                    d="M15.2451 1.63672L17.5293 3.9209L15.788 5.66297L13.5038 3.37879L15.2451 1.63672ZM6.87891 12.2871H9.16309L14.7114 6.73882L12.4272 4.45464L6.87891 10.0029V12.2871Z"
                                                                                                                                                                                    fill="white"></path>
                                                                                                                                                                                <path
                                                                                                                                                                                    d="M15.2526 14.5715H6.99758C6.97778 14.5715 6.95723 14.5791 6.93743 14.5791C6.91231 14.5791 6.88718 14.5722 6.86129 14.5715H4.5931V3.91195H9.80636L11.3291 2.38916H4.5931C3.75328 2.38916 3.07031 3.07137 3.07031 3.91195V14.5715C3.07031 15.412 3.75328 16.0942 4.5931 16.0942H15.2526C15.6565 16.0942 16.0438 15.9338 16.3294 15.6482C16.615 15.3627 16.7754 14.9753 16.7754 14.5715V7.9717L15.2526 9.49449V14.5715Z"
                                                                                                                                                                                    fill="white"></path>
                                                                                                                                                                            </svg>
                                                                                                                                                                            Edit</button> `: ''}
                                                                ${canDeleteComment ? `
                                                                                                                                                                        <button type="button" class="delete-comment" data-comment-id="${comment.id}"><svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                                                <path
                                                                                                                                                                                    d="M4.3154 15.331C4.3154 15.7348 4.4758 16.1221 4.76131 16.4076C5.04682 16.6931 5.43406 16.8535 5.83784 16.8535H13.45C13.8538 16.8535 14.241 16.6931 14.5265 16.4076C14.812 16.1221 14.9724 15.7348 14.9724 15.331V6.19645H16.4949V4.67402H13.45V3.15158C13.45 2.74781 13.2896 2.36057 13.0041 2.07506C12.7186 1.78955 12.3313 1.62915 11.9276 1.62915H7.36027C6.95649 1.62915 6.56926 1.78955 6.28375 2.07506C5.99823 2.36057 5.83784 2.74781 5.83784 3.15158V4.67402H2.79297V6.19645H4.3154V15.331ZM7.36027 3.15158H11.9276V4.67402H7.36027V3.15158ZM6.59905 6.19645H13.45V15.331H5.83784V6.19645H6.59905Z"
                                                                                                                                                                                    fill="white"></path>
                                                                                                                                                                                <path
                                                                                                                                                                                    d="M7.35938 7.71899H8.88181V13.8087H7.35938V7.71899ZM10.4042 7.71899H11.9267V13.8087H10.4042V7.71899Z"
                                                                                                                                                                                    fill="white"></path>
                                                                                                                                                                            </svg>
                                                                                                                                                                            Delete</button>` : ''}
                                                            </div>
                                                        </div>
                                                        <div class="content-area-comment">
                                                            <p>${comment.comment}</p>
                                                        </div>
                                                    </div>
                                                    `;
                                            });
                                            moreComments += `</div>`;
                                        }
                                    }

                                    // Define a character limit for the displayed text
                                    const contentLimit = 300;
                                    const isLongContent = post.content.length > contentLimit;
                                    const truncatedContent = isLongContent ? post.content.substring(0,
                                        contentLimit) + '...' : post.content;

                                    const likedStyle = post.hasLiked ? "liked" : "";


                                    $("#post-detaling").append(`
                                        <div class="shadow-box post-detaling">
                                            <div class="main-admin-blog">
                                                    <div class="parent-person-box">
                                                        <div class="person-details">
                                                            <img src="{{ Storage::url('${post.user.image}') }}" alt="">
                                                            <div class="content">
                                                                <h6>${post.user.name}</h6>
                                                                <h5>${post.user.email}</h5>
                                                            </div>
                                                        </div>
                                                        <div class="person-details-date">
                                                            <h4>${timeAgo(post.created_at)}</h4>
                                                        </div>
                                                    </div>
                                                    <div class="detalingsread-more">
                                                        <div class="content">
                                                            <p>
                                                                <span class="less-text">${truncatedContent}
                                                                </span> <span class="more-text" style="display:none;">${post.content}</span>
                                                                ${isLongContent ? '<a href="javascript:void(0);" class="read-more-btn" onclick="toggleText(this)">Read more...</a>' : ''}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="scroll-full-box">
                                                        ${imageSection}
                                                        ${videoSection}
                                                    </div>
                                                    <div class="comment-input-box">
                                                        <div class="box input-box">
                                                                <input type="text" id="commentInput" placeholder="What’s on your mind?">
                                                                <button onclick="addComment(${post.id}, this)">Comment</button>
                                                        </div>
                                                        <div class="two-btns-inline">
                                                            <div class="box like-btn">
                                                                <button id="likeButton" class="${likedStyle}" onclick="likePost(${post.id}, this)">
                                                                    <svg width="25" height="26" viewBox="0 0 25 26" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M20.834 8.83325H14.9882L16.1579 5.32596C16.3684 4.69263 16.2621 3.99054 15.8715 3.44888C15.4809 2.90721 14.8475 2.58325 14.1798 2.58325H12.5007C12.1913 2.58325 11.8986 2.72075 11.6996 2.95825L6.80378 8.83325H4.16732C3.01836 8.83325 2.08398 9.76763 2.08398 10.9166V20.2916C2.08398 21.4405 3.01836 22.3749 4.16732 22.3749H18.0288C18.4526 22.3735 18.8661 22.2435 19.2144 22.0021C19.5628 21.7607 19.8297 21.4192 19.9798 21.0228L22.8517 13.3655C22.8953 13.2486 22.9175 13.1247 22.9173 12.9999V10.9166C22.9173 9.76763 21.9829 8.83325 20.834 8.83325ZM4.16732 10.9166H6.25065V20.2916H4.16732V10.9166ZM20.834 12.8114L18.0288 20.2916H8.33398V10.252L12.9882 4.66659H14.1819L12.5548 9.54471C12.502 9.70129 12.4873 9.8682 12.5118 10.0316C12.5364 10.195 12.5996 10.3502 12.6961 10.4843C12.7927 10.6185 12.9198 10.7276 13.067 10.8028C13.2141 10.878 13.3771 10.917 13.5423 10.9166H20.834V12.8114Z"
                                                                            fill="#222222" />
                                                                    </svg>
                                                                    <span id="like-count-${post.id}">${formatCount(post.likeCount)}</span> Likes
                                                                </button>
                                                            </div>
                                                            <div class="box like-btn">
                                                                <button id="commentButton"><svg width="25" height="26" viewBox="0 0 25 26" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M5.20833 2.58325C4.05937 2.58325 3.125 3.51763 3.125 4.66659V17.1666C3.125 18.3155 4.05937 19.2499 5.20833 19.2499H8.94375L12.5 22.8062L16.0562 19.2499H19.7917C20.9406 19.2499 21.875 18.3155 21.875 17.1666V4.66659C21.875 3.51763 20.9406 2.58325 19.7917 2.58325H5.20833ZM19.7917 17.1666H15.1938L12.5 19.8603L9.80625 17.1666H5.20833V4.66659H19.7917V17.1666Z"
                                                                            fill="#222222" />
                                                                        <path
                                                                            d="M7.29102 7.79175H17.7077V9.87508H7.29102V7.79175ZM7.29102 11.9584H14.5827V14.0417H7.29102V11.9584Z"
                                                                            fill="#222222" />
                                                                    </svg>

                                                                    <span id="comment-count-${post.id}">${formatCount(post.comments.length)}</span> Comments</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="post-${post.id}" class="person-comments-section">

                                                    ${commentSection}
                                                    ${moreComments}

                                                    ${post.comments.length > 1 ? '<button id="toggleBtn" onclick="toggleComments(this)" class="show-more">See More...</button>' : ''}
                                            </div>
                                        </div>
                            `);
                                })
                            }

                            currentPage++;
                        },
                        error: function(xhr) {
                            alert('An error occurred while loading more posts.');
                        }
                    });
                }

                function likePost(postId, button) {
                    var button = button;

                    $.ajax({
                        url: `/like/${postId}`,
                        type: 'POST',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.liked == true) {
                                button.classList.add('liked');
                            } else if (response.liked == false) {
                                button.classList.remove('liked');
                            }
                            $("#like-count-" + postId).text(formatCount(response.likes));
                        },
                        error: function(xhr) {
                            alert('An error occurred while liking/unliking the post.');
                        }
                    });
                }

                function addComment(postId, element) {
                    const parentBox = $(element).closest('.comment-input-box');
                    const content = parentBox.find("#commentInput").val();

                    $.ajax({
                        url: `/comment/${postId}`, // Post comment endpoint
                        type: 'POST',
                        data: {
                            content: content,
                            post_id: postId,
                            _token: '{{ csrf_token() }}' // Add CSRF token for Laravel
                        },
                        success: function(response) {
                            // Clear the input field after submitting the comment
                            parentBox.find("#commentInput").val('');
                            $("#comment-count-" + postId).text(response.count);
                            var img = response.comment.user.image;
                            // Construct the new comment HTML based on the response
                            let newComment = `
                                    <div class="person-comment-content">
                                        <div class="person-comment-box">
                                            <div class="img-box">
                                                <div class="img">
                                                    <img ${img ? `src="{{ Storage::url('${img}') }}"` : 'src="{{ asset('assets/images/tony-stark-img.png') }}"'} width="100%" height="40px" alt="">
                                                </div>
                                                <div class="content-name">
                                                    <h6>${response.comment.user.name} <span style="font-size: 10px; font-weight: 400; color: #777777;">&nbsp | ${timeAgo(response.comment.created_at)}</span></h6>
                                                    <h5>${response.comment.user.email}</h5>
                                                </div>
                                            </div>
                                            <div class="two-btns-inline">
                                                
                                                <button type="button" class="btn btn-primary" data-comment-id="${response.comment.id}" data-toggle="modal"
                                                    data-target="#exampleModal"><svg width="20" height="19"
                                                        viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.2451 1.63672L17.5293 3.9209L15.788 5.66297L13.5038 3.37879L15.2451 1.63672ZM6.87891 12.2871H9.16309L14.7114 6.73882L12.4272 4.45464L6.87891 10.0029V12.2871Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M15.2526 14.5715H6.99758C6.97778 14.5715 6.95723 14.5791 6.93743 14.5791C6.91231 14.5791 6.88718 14.5722 6.86129 14.5715H4.5931V3.91195H9.80636L11.3291 2.38916H4.5931C3.75328 2.38916 3.07031 3.07137 3.07031 3.91195V14.5715C3.07031 15.412 3.75328 16.0942 4.5931 16.0942H15.2526C15.6565 16.0942 16.0438 15.9338 16.3294 15.6482C16.615 15.3627 16.7754 14.9753 16.7754 14.5715V7.9717L15.2526 9.49449V14.5715Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    Edit</button> 
                                    
                                                <button type="button" class="delete-comment" data-comment-id="${response.comment.id}"><svg width="19" height="19" viewBox="0 0 19 19" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.3154 15.331C4.3154 15.7348 4.4758 16.1221 4.76131 16.4076C5.04682 16.6931 5.43406 16.8535 5.83784 16.8535H13.45C13.8538 16.8535 14.241 16.6931 14.5265 16.4076C14.812 16.1221 14.9724 15.7348 14.9724 15.331V6.19645H16.4949V4.67402H13.45V3.15158C13.45 2.74781 13.2896 2.36057 13.0041 2.07506C12.7186 1.78955 12.3313 1.62915 11.9276 1.62915H7.36027C6.95649 1.62915 6.56926 1.78955 6.28375 2.07506C5.99823 2.36057 5.83784 2.74781 5.83784 3.15158V4.67402H2.79297V6.19645H4.3154V15.331ZM7.36027 3.15158H11.9276V4.67402H7.36027V3.15158ZM6.59905 6.19645H13.45V15.331H5.83784V6.19645H6.59905Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M7.35938 7.71899H8.88181V13.8087H7.35938V7.71899ZM10.4042 7.71899H11.9267V13.8087H10.4042V7.71899Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    Delete</button>
                                            </div>
                                        </div>
                                        <div class="content-area-comment">
                                            <p>${response.comment.comment}</p>
                                        </div>
                                    </div>
                                    `;

                            // Find the comments section of the specific post
                            const commentsSection = $("#post-" + postId);
                            const moreCommentsDiv = commentsSection.find('.more-comments');

                            // If there is a "more-comments" div (hidden comments), append to that
                            if (moreCommentsDiv.length > 0) {
                                moreCommentsDiv.append(newComment); // Append to the hidden comments
                            } else {
                                // If there's only one comment, append the new comment after the first one
                                commentsSection.append(newComment);
                            }
                        },
                        error: function(xhr) {
                            alert('An error occurred while submitting the comment.');
                        }
                    });
                }

                $(document).on('click', '.btn-primary[data-toggle="modal"]', function() {
                    const commentElement = $(this).closest('.person-comment-content');
                    const commentText = commentElement.find('.content-area-comment p').text();
                    const commentId = $(this).data('comment-id'); // Get comment ID from button's data attributes

                    $('#editCommentInput').val(commentText); // Set the current comment text in the modal
                    $('#commentId').val(commentId); // Set the comment ID in a hidden input field

                    // Open the modal
                    $('#exampleModal').modal('show');
                });

                $('#editCommentForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent the form from submitting the default way

                    const commentId = $('#commentId').val(); // Get the comment ID
                    const updatedContent = $('#editCommentInput').val(); // Get the updated comment text

                    const updateUrl = `{{ route('comment.update', ':id') }}`.replace(':id', commentId); // Create the URL
                    $.ajax({
                        url: updateUrl,
                        type: 'POST', // Change this to your appropriate method (e.g., PATCH)
                        data: {
                            content: updatedContent,
                            _token: '{{ csrf_token() }}' // CSRF token for Laravel
                        },
                        success: function(response) {
                            console.log(response);

                            // Update the comment text in the UI
                            const commentElement = $(`.delete-comment[data-comment-id="${commentId}"]`).closest(
                                '.person-comment-content');
                            commentElement.find('.content-area-comment p').text(updatedContent);

                            // Close the modal
                            // $('#exampleModal').modal('hide');
                            $('#exampleModal button[data-dismiss="modal"], .close').click();


                            // Optionally show a success message
                            Swal.fire("Updated!", "Your comment has been updated.", "success");
                        },
                        error: function(xhr) {
                            Swal.fire("Error!", "An error occurred while updating the comment.", "error");
                        }
                    });
                });

                $(document).on('click', '#exampleModal button[data-dismiss="modal"], .close', function() {
                    $('#exampleModal').modal('hide'); // Ensure the modal is hidden
                });

                $('#exampleModal').on('hidden.bs.modal', function() {
                    // Reset any values in the modal
                    $(this).find('textarea').val(''); // Clear textarea if needed
                });





                $(document).on('click', '.delete-comment', function() {
                    const deleteUrl = `{{ route('comment.delete', ':id') }}`;
                    const finalUrl = deleteUrl.replace(':id', $(this).data('comment-id'));
                    const commentElement = $(this).closest('.person-comment-content');

                    // SweetAlert for confirmation
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this comment!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, keep it'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: finalUrl,
                                type: 'POST', // Use DELETE method if that's what your route expects
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log(response);
                                    commentElement.remove(); // Remove the comment from the DOM
                                    Swal.fire("Deleted!", "Comment deleted successfully!", "success");
                                    $("#comment-count-" + response.comment.post_id).text(response
                                        .count);
                                },
                                error: function(xhr) {
                                    Swal.fire("Error!", "An error occurred while deleting the comment.",
                                        "error");
                                }
                            });
                        } else {
                            Swal.fire("Cancelled", "Your comment is safe!", "info");
                        }
                    });
                });


                $(document).ready(function() {
                    loadPosts();
                    Pusher.logToConsole = false;

                    var pusher = new Pusher('3af0341c542582fe2550', {
                        cluster: "ap2",
                        encrypted: false,
                        useTls: true,
                    });

                    var channel = pusher.subscribe('community-feed');

                    channel.bind('post-created', function(data) {
                        console.log("Hamamd", data);
                    });

                });

                // -- JS for frontend -- //
                document.getElementById('popular-btn').addEventListener('click', function() {
                    this.classList.add('active');
                    document.getElementById('hot-btn').classList.remove('active');
                });

                document.getElementById('hot-btn').addEventListener('click', function() {
                    this.classList.add('active');
                    document.getElementById('popular-btn').classList.remove('active');
                });

                function toggleText(button) {
                    // Find the parent <p> element
                    const paragraph = button.parentElement;

                    // Find the <span> with class 'more-text' within the paragraph
                    const moreText = paragraph.querySelector('.more-text');
                    const lessText = paragraph.querySelector('.less-text');


                    // Toggle the visibility of the more-text
                    if (moreText.style.display === "none") {
                        moreText.style.display = "inline"; // Show the extra text
                        lessText.style.display = "none";
                        button.innerText = "Read less..."; // Change button text
                    } else {
                        moreText.style.display = "none"; // Hide the extra text
                        lessText.style.display = "inline";
                        button.innerText = "Read more..."; // Change button text
                    }
                }

                $("#likeButton").on('click', function() {
                    $(this).toggleClass('liked');
                });

                function toggleComments(button) {
                    const moreCommentsDiv = button.previousElementSibling;
                    if (moreCommentsDiv.style.display === "none") {
                        moreCommentsDiv.style.display = "block";
                        button.innerText = "See Less...";
                    } else {
                        moreCommentsDiv.style.display = "none";
                        button.innerText = "See More...";
                    }
                }


                // -- JS for backend -- //
            </script>
        @endsection
