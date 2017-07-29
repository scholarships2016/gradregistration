<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
        <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
       @if(session('locale'))        
        
        <li class="dropdown dropdown-language">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false">
                                    <img alt="" src="{{url('/assets/global/img/flags/'.session('locale').'.png')}}">
                                    <span class="langname"> {{strtoupper(session('locale'))}} </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>       
                                <ul class="dropdown-menu dropdown-menu-default">
                                       @foreach(config('app.languages') as $lang)
                                    <li>
                                        <a href="/language?lang={{ $lang }}">
                                            <img alt="" src="{{url('/assets/global/img/flags/'.$lang.'.png')}}"> {{ strtoupper($lang) }} </a>
                                    </li>   
                                       @endforeach
                                </ul>
                            </li>
        
        @endif
        <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hove                                   r="dropdown"
               data-close-others="true">
                <i class="icon-bell"></i>
                <span id="regHeadsum" name="regHeadsum" class="badge badge-default">  </span>
            </a>
            <ul class="dropdown-menu">  @if(session('user_id'))
                <li class="external">
                    <h3>
                        <span class="bold"><label id="regHeadsum2" name="regHeadsum2"  ></label> pending</span> notifications</h3>
                   
                </li>
                @endif
                <li>
                    <ul id ="regHead" name="regHead" class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                      
                       
                                        </ul>
                                        </li>
                                        </ul>
                                        </li>
                                        <!-- END NOTIFICATION DROPDOWN -->
                                        <!-- BEGIN INBOX DROPDOWN -->
                                        
                                        @if(session('user_id'))
                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                                        <li class="dropdown dropdown-user">
                                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                                               data-close-others="true">
                                                <img alt="" class="img-circle" id='userimg' src="{{url('/assets/layouts/layout/img/avatar3_small.jpg')}}"/>
                                                <span class="username username-hide-on-mobile">  {{ session('first_name').' '.session('last_name')  }} </span>
                                                <i class="fa fa-angle-down"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-default">
                                                <li>
                                                    <a href="{{route('profile.showProfilePage')}}">
                                                        <i class="icon-user"></i> My Profile </a>
                                                </li>
                                                <li class="divider"></li>
                                               
                                                <li>
                                                    <a href="{{ url('/logout') }}">
                                                        <i class="icon-key"></i> Log Out </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- END USER LOGIN DROPDOWN -->
                                        @endif
                                        </ul>
  </div>

<script>
    
 $.ajax({
					type: "GET",
					url: '{!! Route('showRegisHead') !!}',
					data :{ 
                                            _token:     '{{ csrf_token() }}'
                                               } ,
					success : function(data){ 
                                  	   $('#regHead').html(data['val']); 
                                           $('#regHeadsum2').html(data['cot']);
                                           $('#regHeadsum').html(data['cot']);
                                           if(data['cusimg']) $('#userimg').attr("src",data['cusimg']);
                                            
					}
				});


    

</script>
 