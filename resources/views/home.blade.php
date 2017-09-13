@extends('layouts.default')

@push('pageCss')
<link id="style_color" href="../assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css">
<link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css">
 <link href="../assets/pages/css/about.min.css" rel="stylesheet" type="text/css">
 <link href="css/custom.css" rel="stylesheet" type="text/css">
<style type="text/css">

</style>
@endpush

@section('pagebar')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{url('home/')}}">{{Lang::get('resource.lbMHome')}}</a>
                <i class="fa fa-circle"></i>
            </li>

        </ul>

    </div>
@stop

@section('pagetitle')

@stop



@section('maincontent')

                        <h1 class="page-title"> {{Lang::get('resource.lbHomeWelcome')}}
                            <small>{{Lang::get('resource.lbHomeSystemName')}}</small>
                        </h1>


                        <div class="row margin-bottom-40">
                            <!-- Start Left Panel -->
                            <div class="col-md-8">
                                <div class="row margin-bottom-20 about-header">
                                    <div class="col-md-12">
                                        <h1>{{Lang::get('resource.lbHomeOpenRegister')}}</h1>
                                        @if($Applys)
                                         <h3>{!!(session('locale')=='th'?Lang::get('resource.lbSemester').''.($Applys->semester==1?'ต้น':'ปลาย'):'<span style="text-transform: lowercase;">'.(($Applys->semester==1)?'1st ':'2nd').'</span>'.Lang::get('resource.lbSemester').',') !!}  {{Lang::get('resource.lbHomeYear').' '.$Applys->academic_year}}  </h3>
                                        <h4>{{Lang::get('resource.lbroundNo').' '.$Applys->round_no.' '.Lang::get('resource.lbStartDate').' '. $Applys->start_date->format('d/m/Y').' '. Lang::get('resource.lbFromTo') .' '.$Applys->end_date->format('d/m/Y')}} </h4>
                                          @if(session('user_id'))
                                            <a href="apply"><button class="btn btn-info" type="button"><i class="fa fa-check"></i> {{Lang::get('resource.lbSelect')}}  </button></a>
                                          @endif
                                          @if(!session('user_id'))
                                            <a href="apply/register"><button class="btn btn-info" type="button"><i class="fa fa-check"></i> {{Lang::get('resource.lbSelect')}}  </button></a>
                                          @endif
   @endif
                                    </div>
                                </div>
                                 @foreach ($NewsList as $news)
                                <div class="row margin-bottom-20">
                                    <div class="col-lg-12">
                                        <div class="portlet light about-text">
                                            <h4>
                                                <i class="fa fa-check icon-info"></i>  {{(session('locale')=='th')?$news->news_title :$news->news_title_en}}</h4>

                                            <p class="margin-top-20">
                                            {!!(session('locale')=='th')?$news->news_detail:$news->news_detail_en!!}
                                            </p>

                                            <div class="about-quote">
                                                <p class="about-author">{{($news->modified)?$news->modified->format('d-m-Y H:i'):$news->created->format('d-m-Y H:i')}}<br> </p>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                                   @endforeach
                            </div>
                            <!-- End Left Panel -->
                            <!-- Start Right Panel -->
                            <div class="col-md-4">
                              @if(session('user_id'))
                              <div class="row margin-bottom-20"><a href="{{url('apply')}}">
                                  <div class="col-md-12">
                                      <div class="portlet light">
                                          <div class="card-icon">
                                              <i class="icon-note font-green-haze theme-font"></i>
                                          </div>
                                          <div class="card-title">
                                              <span>{{Lang::get('resource.lbHomeApply')}}</span>
                                          </div>
                                          <div class="card-desc">
                                              <span> {{Lang::get('resource.lbHomeApplyDescription')}} </span>
                                          </div>
                                      </div>
                                  </div></a>
                                </div>
                                      @endif
                                @if(session('user_id'))
                                <div class="row margin-bottom-20"><a href="{{url('application/manageMyCourse')}}">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-check font-red-pink theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>{{Lang::get('resource.lbHomeApplyAndCheckStatus')}}</span>
                                            </div>
                                            <div class="card-desc">
                                                <span> {{Lang::get('resource.lbHomeApplyAndCheckStatusDesc')}} </span>
                                            </div>
                                        </div>
                                    </div></a>
                                  </div>
                                        @endif
                                        @if(!session('user_id'))
                                    <div class="row margin-bottom-20"><a href="{{url('login')}}">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-user-follow font-red-pink theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>{{Lang::get('resource.lbHomeRegistration')}}</span>
                                            </div>
                                            <div class="card-desc">
                                                <span>  {{Lang::get('resource.lbHomeRegistrationDesc')}}  </span>
                                            </div>
                                        </div>
                                    </div></a>
                                        </div>
                                          @endif
                                    <div class="row margin-bottom-20"><a href="{{url('contact')}}">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="card-icon">
                                                <i class="icon-pointer font-blue theme-font"></i>
                                            </div>
                                            <div class="card-title">
                                                <span>{{Lang::get('resource.lbHomeContactus')}}</span>
                                            </div>
                                            <div class="card-desc">
                                                <span> {{Lang::get('resource.lbHomeContactusDesc')}} </span>
                                            </div>
                                        </div>
                                    </div></a>
                                </div>
                            </div>
                            <!-- End Right Panel -->
                        </div>



@stop


@push('pageJs')
<script type="application/javascript">
    $(document).ready(function () {

    });
</script>
@endpush
