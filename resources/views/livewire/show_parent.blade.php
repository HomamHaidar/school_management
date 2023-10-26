@if(!$show_one_father)
    <div style="display: none" class="row setup-content" id="step-1">
@endif
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('Parent_trans.Father_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " id="home-03-tab" data-toggle="tab" href="#home-03"
                                       role="tab" aria-controls="home-03"
                                       aria-selected="false">{{trans('Parent_trans.Mother_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                                </li>
                            </ul>



                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('Parent_trans.Name_F')}}</th>
                                            <td>{{$Parent->Name_Father}}</td>
                                            <th scope="row">{{trans('Parent_trans.Email')}}</th>
                                            <td>{{$Parent->email}}</td>
                                            <th scope="row">{{trans('Parent_trans.Address_Father')}}</th>
                                            <td>{{$Parent->Address_Father}}</td>
                                        </tr>

                                        <tr>

                                            <th scope="row">{{trans('Parent_trans.Phone_Father')}}</th>
                                            <td>{{$Parent->Phone_Father}}</td>

                                            <th scope="row">{{trans('Parent_trans.National_ID_Father')}}</th>
                                            <td>{{$Parent->National_ID_Father}}</td>

                                            <th scope="row">{{trans('Parent_trans.Passport_ID_Father')}}</th>
                                            <td>{{$Parent->Passport_ID_Father}}</td>

                                        </tr>


                                        <tr>
                                            <th scope="row">{{trans('Parent_trans.Blood_Type_Father_id')}}</th>
                                            <td>
                                                 @foreach($Type_Bloods as $blood)
                                                     {{$Parent->Blood_Type_Father_id==$blood->id ?$blood->Name:" "}}

                                                @endforeach

                                            </td>
                                            <th scope="row">{{trans('Parent_trans.Nationality_Father_id')}}</th>
                                            <td>
                                                @foreach($Nationalities as $N)
                                                    {{$Parent->Nationality_Father_id==$N->id ?$N->Name:" "}}
                                                @endforeach</td>
                                            <th scope="row">{{trans('Parent_trans.Religion_Father_id')}}</th>
                                            <td>
                                                @foreach($Religions as $R)
                                                    {{$Parent->Religion_Father_id==$R->id ?$R->Name:" "}}
                                                @endforeach
                                            </td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Parent_trans.Job_F')}}</th>
                                            <td>{{$Parent->Job_Father}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="home-03" role="tabpanel"
                                     aria-labelledby="home-03-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                      <tbody>
                                        <tr>
                                            <th scope="row">{{trans('Parent_trans.Name_M')}}</th>
                                            <td>{{$Parent->Name_Mother}}</td>
                                            <th scope="row">{{trans('Parent_trans.Phone_Mother')}}</th>
                                            <td>{{$Parent->Phone_Mother}}</td>
                                            <th scope="row">{{trans('Parent_trans.Address_Mother')}}</th>
                                            <td>{{$Parent->Address_Mother}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Parent_trans.Job_M')}}</th>
                                            <td>{{$Parent->Job_Mother}}</td>
                                            <th scope="row">{{trans('Parent_trans.National_ID_Mother')}}</th>
                                            <td>{{$Parent->National_ID_Mother}}</td>
                                            <th scope="row">{{trans('Parent_trans.Passport_ID_Mother')}}</th>
                                            <td>{{$Parent->Passport_ID_Mother}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Parent_trans.Blood_Type_Father_id')}}</th>
                                            <td>
                                                @foreach($Type_Bloods as $blood)
                                                    {{$Parent->Blood_Type_Mothers_id==$blood->id ?$blood->Name:" "}}
                                                @endforeach

                                            </td>
                                            <th scope="row">{{trans('Parent_trans.Nationality_Father_id')}}</th>
                                            <td>
                                                @foreach($Nationalities as $N)
                                                    {{$Parent->Nationality_Mothers_id==$N->id ?$N->Name:" "}}
                                                @endforeach</td>
                                            <th scope="row">{{trans('Parent_trans.Religion_Father_id')}}</th>
                                            <td>
                                                @foreach($Religions as $R)
                                                    {{$Parent->Religion_Mothers_id==$R->id ?$R->Name:" "}}
                                                @endforeach
                                            </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form wire:submit.prevent="Submit_attachment_update({{$Parent->id}},'{{$Parent->National_ID_Father}}')">
                                                <input type="file" wire:model="photos" multiple>

                                                <input type="hidden" wire:model="Parent_id">

                                                @error('photo') <span class="error">{{ $message }}</span> @enderror

                                                <button type="submit">Save Photo</button>
                                            </form>

                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('Students_trans.filename')}}</th>
                                                <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                                <th scope="col">{{trans('Students_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($Parent->images  as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->file_name}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>

                                                    <td colspan="2">

                                                        <button class="btn btn-outline-info btn-sm"

                                                           wire:click="Download_attachment({{ $Parent->National_ID_Father }}, '{{$attachment->file_name}}')"
                                                           ><i class="fas fa-download"></i>&nbsp; {{trans('Students_trans.Download')}} </button>

{{--                                                        <button type="button" class="btn btn-outline-danger btn-sm"--}}
{{--                                                                href="{{Delete_attachment( $Parent->National_ID_Father , $attachment->file_name,$attachment->imageable->id)}}"--}}
{{--                                                                title="{{ trans('Grades_trans.Delete') }}">{{trans('Students_trans.delete')}}--}}
{{--                                                        </button>--}}

                                                    </td>
                                                </tr>



                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- row closed -->
