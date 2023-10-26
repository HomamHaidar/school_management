
<div>



{{--   @if (!empty($successMessage))--}}
{{--        <div class="alert alert-success" id="success-alert">--}}
{{--            <button type="button" class="close" data-dismiss="alert">x</button>--}}
{{--            {{ $successMessage }}--}}
{{--        </div>--}}
{{--    @endif--}}


    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif


    @if($show_table)

        @include('livewire.Parent_table')

    @elseif($show_one_father)

            @include('livewire.show_parent')
    @else
       <div class="stepwizard">
         <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#" type="button"
                class="btn btn-circle {{ $currentStep != 1 ? 'btn-secondary' : 'btn-success' }}">1</a>
                <p>{{ trans('Parent_trans.Step1') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#" type="button"
                class="btn btn-circle {{ $currentStep != 2 ? 'btn-secondary' : 'btn-success' }}">2</a>
                <p>{{ trans('Parent_trans.Step2') }}</p>
            </div>
            <div class="stepwizard-step">
                <a href="#" type="button"
                class="btn btn-circle {{ $currentStep != 3 ? 'btn-secondary' : 'btn-success' }}"
                disabled="disabled">3</a>
                <p>{{ trans('Parent_trans.Step3') }}</p>
            </div>
        </div>
    </div>

        @include('livewire.Father_Form')

        @include('livewire.Mother_Form')

        <!--last_form-->
        <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
              @if ($currentStep != 3)
                <div style="display: none" class="row setup-content" id="step-3">
            @endif

                    <div class="col-xs-12">
                        <div class="col-md-12"><br>
                            <label style="color: red">{{trans('Parent_trans.Attachments')}}</label>

                            @if($update_mode)


                                <div class="form-group">
                                    <button class="btn btn-warning btn-group-sm nextBtn  pull-right text-white font-bold" wire:click="show({{$Parent_id}})" type="button">{{trans('Parent_trans.Parents_Attachments')}}</button>
                                </div>
                                    <br>
                                    <br>
                            @else

                                <div class="form-group">
                                    <input type="file" wire:model="photos" accept="image/*" multiple>
                                </div>
                            @endif
                            <br>

                              <input type="hidden" wire:model="Parent_id">

                            <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                                    wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>


                            @if($update_mode)
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                                        type="button">{{trans('Parent_trans.Finish')}}
                                </button>

                                <a class="btn btn-secondary btn-sm btn-lg pull-left text-white"  href="{{route('add_parent')}}" style="">{{trans('Parent_trans.Back_to_parent_list')}}</a>

                            @else
                                <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                                        type="button">{{ trans('Parent_trans.Finish') }}</button>


                                <div>
                                    <a class="btn btn-secondary btn-sm btn-lg left text-white"  href="{{route('add_parent')}}" >{{trans('Parent_trans.Back_to_parent_list')}}</a>
                                </div>

                            @endif


                        </div>
                    </div>
                </div>
            @endif

        </div>
