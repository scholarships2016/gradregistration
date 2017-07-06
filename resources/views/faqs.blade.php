@extends('layouts.default')

@push('pageCss')
<link id="style_color" href="../assets/layouts/layout/css/themes/light2.min.css" rel="stylesheet" type="text/css">
<link href="../assets/pages/css/contact.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
.page-content{max-height: 750px;}
</style>
@endpush

@section('pagebar')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('faq/')}}">{{Lang::get('resource.lbMFAQs')}}</a>
            <i class="fa fa-circle"></i>
        </li>

    </ul>
  
</div>
@stop

@section('pagetitle')

@stop



@section('maincontent')
 <div class="note note-info">
                            <p>{{Lang::get('resource.lbMFAQs')}} </p>
                        </div>

<div class="row">
                          <div class="col-md-12">
                                                  <div class="tab-content">
                                                      <div id="tab_1" class="tab-pane active">
                                                          <div id="accordion1" class="panel-group">
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_1" aria-expanded="true"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_1" class="panel-collapse collapse in" aria-expanded="true">
                                                                      <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt
                                                                          laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore
                                                                          wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably
                                                                          haven't heard of them accusamus labore sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_2" aria-expanded="false"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                          enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                          moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                          ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                                                          sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-success">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_3" aria-expanded="false"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                          enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                          moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                          ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                                                          sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-warning">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_4" aria-expanded="false"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_4" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-danger">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_5" aria-expanded="false"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_5" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_6" aria-expanded="false"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_6" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion1_7" aria-expanded="false"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion1_7" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div id="tab_2" class="tab-pane">
                                                          <div id="accordion2" class="panel-group">
                                                              <div class="panel panel-warning">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_1"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_1" class="panel-collapse collapse in">
                                                                      <div class="panel-body">
                                                                          <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                                                              nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                                              beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                                                              you probably haven't heard of them accusamus labore sustainable VHS. </p>
                                                                          <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                                                              nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft
                                                                              beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt
                                                                              you probably haven't heard of them accusamus labore sustainable VHS. </p>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-danger">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_2"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_2" class="panel-collapse collapse">
                                                                      <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                          enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                          moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                          ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                                                          sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-success">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_3"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_3" class="panel-collapse collapse">
                                                                      <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                          enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                          moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                          ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                                                          sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_4"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_4" class="panel-collapse collapse">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_5"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_5" class="panel-collapse collapse">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_6"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_6" class="panel-collapse collapse">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#accordion2_7"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion2_7" class="panel-collapse collapse">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                      <div id="tab_3" class="tab-pane">
                                                          <div id="accordion3" class="panel-group">
                                                              <div class="panel panel-danger">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_1" aria-expanded="false"> 1. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                      <div class="panel-body">
                                                                          <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                                                              nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                                          <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa
                                                                              nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </p>
                                                                          <p> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,
                                                                              craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth
                                                                              nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </p>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-success">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_2" aria-expanded="false"> 2. Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_2" class="panel-collapse collapse" aria-expanded="false">
                                                                      <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                          enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                          moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                          ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                                                          sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_3" aria-expanded="true"> 3. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_3" class="panel-collapse collapse in" aria-expanded="true">
                                                                      <div class="panel-body"> Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Anim pariatur cliche reprehenderit,
                                                                          enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf
                                                                          moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente
                                                                          ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore
                                                                          sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_4" aria-expanded="false"> 4. Wolf moon officia aute, non cupidatat skateboard dolor brunch ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_4" class="panel-collapse collapse" aria-expanded="false">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_5" aria-expanded="false"> 5. Leggings occaecat craft beer farm-to-table, raw denim aesthetic ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_5" class="panel-collapse collapse" aria-expanded="false">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_6" aria-expanded="false"> 6. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_6" class="panel-collapse collapse" aria-expanded="false">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                              <div class="panel panel-default">
                                                                  <div class="panel-heading">
                                                                      <h4 class="panel-title">
                                                                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion3" href="#accordion3_7" aria-expanded="false"> 7. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft ? </a>
                                                                      </h4>
                                                                  </div>
                                                                  <div id="accordion3_7" class="panel-collapse collapse" aria-expanded="false">
                                                                      <div class="panel-body"> 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin
                                                                          coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings
                                                                          occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. Food truck quinoa nesciunt laborum eiusmod.
                                                                          Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et </div>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                        </div>

@stop


@push('pageJs')

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCn-qdME6ljUshU0gN9ZeT_cOPVYXvQcBE&callback=initMap&language={{strtoupper(session('locale'))}}&region={{strtoupper(session('locale'))}}"
type="text/javascript"></script>
<script type="application/javascript">
      function initMap() {
        var uluru = {lat: 13.73841, lng: 100.52826};
        var map = new google.maps.Map(document.getElementById('gmapbg'), {
          zoom: 16,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }  
</script>
@endpush