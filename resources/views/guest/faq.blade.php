@extends('guest.layouts.main')
<style>
    header .header-nav ul li a.faq-active::after {
        opacity: 100%;

    }
</style>
@section('content')
    <section class="faq-sec-01">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text text-center">
                        <h2>Frequently <span>Asked</span> <br> Questions </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-sec-02">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="tabs-main">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Lorem is a dummy text for printing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat aute irure dolor
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Lorem is a dummy text for printing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat aute irure dolor
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Lorem is a dummy text for printing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat aute irure dolor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="tabs-main">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingfour">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Lorem is a dummy text for printing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="headingfour">
                                    <div class="panel-body">
                                        Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat aute irure dolor
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingfive">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                                            href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            Lorem is a dummy text for printing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingfive">
                                    <div class="panel-body">
                                        Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat aute irure dolor
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSeven">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseSeven" aria-expanded="false"
                                            aria-controls="collapseSeven">
                                            Lorem is a dummy text for printing?
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="headingSeven">
                                    <div class="panel-body">
                                        Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                                        ea commodo consequat aute irure dolor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
