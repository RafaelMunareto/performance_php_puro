@if ($message = Session::get('error'))
<div id='message' class="row center neomorphic-conc text-center borderRadius-10 mt2 animated flipInX col-5" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content ml-1 ">
              <p class=' margin-0 text-red text-uppercase size85'>
                <i class="fas fa-times text-red"></i>
                {{ $message }}</p>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
@endif

@if ($message = Session::get('error_grande'))
<div id='message' class="row center neomorphic-conc text-center borderRadius-10 mt2 animated flipInX col-12" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content ml-1 ">
              <p class=' margin-0 text-red text-uppercase size85'>
                <i class="fas fa-times text-red"></i>
                {{ $message }}</p>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
@endif

@if ($message = Session::get('success'))
 <div id='message' class="row neomorphic-conc  text-center borderRadius-10 mt2 animated flipInX col-5" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content ml-1 ">
              <p class=' margin-0 text-blue text-uppercase size85'>
                <i class="fas fa-check-circle text-blue"></i>
                {{ $message }}</p>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
@endif

@if ($errors->any())
<div id='message' class="row neomorphic-conc  text-center borderRadius-10 mt2 animated flipInX col-5" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content ml-1 ">
                @foreach ($errors->all() as $error)
                    <p class=' margin-0 text-red text-uppercase size85'>
                        <i class="fas fa-times text-red"></i>
                        {{ $error }}</p>
                @endforeach
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
@endif

@if ($message = Session::get('warning'))
<div id='message' class="row neomorphic-conc  text-center borderRadius-10 mt2 animated flipInX col-5" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content ml-1 ">
              <p class=' margin-0 text-orange text-uppercase size85'>
                <i class="fas fa-exclamation-circle text-orange"></i>
                {{ $message }}</p>
          </div>
        </div>
      </div>
     </div>
    </div>
  </div>
@endif

@if ($message = Session::get('info'))
<div id='message' class="row neomorphic-conc text-center  borderRadius-10 mt-2 animated flipInX col-5" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10 size85">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content  ml-1 ">
              <p class=' margin-0 text-green text-uppercase'>
                <i class="fas fa-exclamation text-green"></i>
                {{ $message }}</p>
          </div>
        </div>
      </div>
     </div>
    </div>
</div>
@endif

@if (session('status'))
<div id='message' class="row neomorphic-conc  text-center border-green borderRadius-10 mt2 animated flipInX col-5" id="alert_box">
    <div class="col s12 m12">
      <div class=" padding-05 borderRadius-10 size85">
        <div class="row">
          <div class="col s12 m10">
            <div class="card-content ml-1 ">
              <p class=' margin-0 text-green text-uppercase'>
                <i class="fas fa-exclamation text-green"></i>
                    {{ session('status') }}</p>
          </div>
        </div>
      </div>
     </div>
    </div>
</div>
@endif

@section('scripts')

<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script>

setInterval(function(){
   $('#message').addClass('animated flipOutX')
}, 3000);
</script>
