<!DOCTYPE html>
<html lang="en">

@include('frontend.components.head')

<body>
    <!-- - - - - - - - - - - - - -  start feedback  - - - - - - - - - - - - - - - - -->
    <div id="feedback-main">   
        <div id="feedback-div">

        <form action="{{ route('frontend_feedback') }}" method="post" class="form" id="feedback-form1" name="form1" enctype="multipart/form-data">
            @csrf
            
            <h4>@lang('tr.Feedback')</h4>

            <p class="name">
            <input name="name" type="name" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input feedback-height" required placeholder="@lang('tr.Name')" id="feedback-name" />
            </p>
    
            <p class="email">
            <input name="email" type="email" class="validate[required,custom[email]] feedback-input feedback-height" id="feedback-email" placeholder="@lang('tr.Email')" required />
            </p>
    
            <p class="text">
            <textarea name="comment" type="comment" class="validate[required,length[6,300]] feedback-input" id="feedback-comment" required placeholder="@lang('tr.Comment')"></textarea>
            </p>
    
            <div class="feedback-submit">
            <div class="row">
                <div class="col-lg-6"><input type="submit" class="btn btn-danger" value="@lang('tr.Send')" id="feedback-button-blue" /></div>
                <div class="col-lg-6"><a onclick="toggle_visibility()" class="btn btn-danger" id="feedback-close">@lang('tr.Close')</a></div>
            </div>
            </div>
        </form>
        </div>
    </div>
  
    <button id="popup" class="feedback-button" onclick="toggle_visibility()" title="@lang('tr.Feedback')"> <i class="far fa-frown-open"></i>&nbsp;<i class="far fa-grin-hearts"></i>&nbsp;<i class="far fa-grin-stars"></i>&nbsp;<i class="far fa-grin"></i> </button>
 
  <!-- - - - - - - - - - - - - -  end feedback  - - - - - - - - - - - - - - - - -->

    <div id="loader" class="loader"></div>

    <div id="wrapper" class="wrapper-container">

    @include('frontend.components.header')

    @yield('content')
    
    </div>



    @include('frontend.components.footer')

    @include('frontend.components.scripts')
</body>
</html>