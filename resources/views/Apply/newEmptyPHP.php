<div class="search-page search-content-4">
    <div class="search-bar bordered">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn green-soft uppercase bold" type="button">Search</button>
                    </span>
                </div>
            </div>
            <div class="col-md-4 extra-buttons">
                <button class="btn grey-steel uppercase bold" type="button">Reset Search</button>
                <button class="btn grey-cararra font-blue" type="button">Advanced Search</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="search-filter ">

                    <div class="col-md-6">
                        <div class="search-label uppercase">Faculty/คณะ</div>
                        <select class="form-control">
                            <select class="select2"  id="faculty_id" class="form-control"> 
                                <option value="" selected="">========== ทั้งหมด ==========</option>
                                @foreach ($facultys as $faculty)
                                <option value="{{$faculty->faculty_id}}">{{$faculty->faculty_name}}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="col-md-6">
                        <div class="search-label uppercase">ประเภทหลักสูตร/Degree</div>
                         <select class="select2"  id="type_of_recruit_id" class="form-control"> 
                        <option value="" selected="" >========== ทั้งหมด ==========</option>
                        @foreach ($typeofRecs as $typeofRec)
                        <option value="{{$typeofRec->	type_of_recruit_id}}">{{$typeofRec->type_of_recruit}}</option>
                        @endforeach
                    </select>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="search-label uppercase">รหัสหลักสูตร/Program ID</</div>
                        <select class="form-control">

                        </select><input type="text" class="form-control spinner"  name="syllabus_id" size="10" maxlength="4" value="">
                    </div>
                    <div class="col-md-6">
                        
                    </div>

                </div>
            </div>
        </div>
        <br>
        <div class="search-table table-responsive">
            <table class="table table-bordered table-striped table-condensed">
                <thead class="bg-blue">
                    <tr>
                        <th>
                            <a href="javascript:;">No.</a>
                        </th>
                        <th>
                            <a href="javascript:;">Degree</a>
                        </th>
                        <th>
                            <a href="javascript:;">Type</a>
                        </th>
                        <th>
                            <a href="javascript:;">Program Detail</a>
                        </th>
                        <th>
                            <a href="javascript:;">View/Apply</a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                1
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">Master of Engineering </a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Doctor Degree Program</a>
                            </h3>
                            <p>Inter National curriculum

                            </p>
                        </td>
                        <td class="table-desc"> Faculty of Engineering <br>
                            Department of Computer <br>
                            Major in Love<br>
                        </td>
                        <td class="table-download">
                            <a class="btn btn-xs green " href="{{url('apply/registerDetailForapply/')}}" type="button"  > 
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                2
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">Master of Engineering </a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Doctor Degree Program</a>
                            </h3>
                            <p>Inter National curriculum

                            </p>
                        </td>
                        <td class="table-desc"> Faculty of Engineering <br>
                            Department of Computer <br>
                            Major in Love<br>
                        </td>
                        <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-check font-grey"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 15, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Typi non habent</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                             <a class="btn btn-xs green " href="{{url('apply/registerDetailForapply/')}}" type="button"  > 
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 12, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Search Result</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                           <a class="btn btn-xs green " href="{{url('apply/registerDetailForapply/')}}" type="button"  > 
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 11, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Mirum est notare</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-check font-grey"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 9, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Reborn</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-check font-grey"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 9, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Reborn</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 6, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Admin Reborn Progress</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="table-status">
                            <a href="javascript:;">
                                <i class="icon-arrow-right font-blue"></i>
                            </a>
                        </td>
                        <td class="table-date font-blue">
                            <a href="javascript:;">October 3, 2015</a>
                        </td>
                        <td class="table-title">
                            <h3>
                                <a href="javascript:;">Metronic Search Page 5</a>
                            </h3>
                            <p>Last Activity:
                                <a href="javascript:;">Bob Robson</a> -
                                <span class="font-grey-cascade">25 mins ago</span>
                            </p>
                        </td>
                        <td class="table-desc"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy sead euismod dolore tincidunt ut laoreet dolore dolor sit amet </td>
                        <td class="table-download">
                            <a href="javascript:;">
                                <i class="icon-doc font-green-soft"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="search-pagination pagination-rounded">
            <ul class="pagination">
                <li class="page-active">
                    <a href="javascript:;"> 1 </a>
                </li>
                <li>
                    <a href="javascript:;"> 2 </a>
                </li>
                <li>
                    <a href="javascript:;"> 3 </a>
                </li>
                <li>
                    <a href="javascript:;"> 4 </a>
                </li>
            </ul>
        </div>
    </div>
</div>