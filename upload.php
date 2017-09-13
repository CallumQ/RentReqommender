<link rel="stylesheet" href="css/foundation.css" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
 <script src="Javascript/vendor/foundation.js"></script>
 
<div class="row">
  <div class="small-4 large-4 columns">
    <label>Audio&nbsp;Volume</label>
  </div>
  <div class="small-6 large-6 columns">
    <div class="slider" id="slidervol" data-slider data-step="1">
      <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="sliderVolOutputHidden"></span>
      <span class="slider-fill" data-slider-fill></span>
    </div>
  </div>
  <div class="small-2 large-2 columns">
    <input name="AudioVolTxtbox" type="number" id="sliderVolOutput" style="width: 4em;" tabindex="2">
    <input type="hidden" id="sliderVolOutputHidden" value="0">
  </div>
</div>
<script>
var target = document.getElementById("slidervol");
var options = {
  "start": 0,
  "end": 100,
  "decimal": 0
};

var elem = new Foundation.Slider($(target), options);
var offset = 50;

$(target).on('moved.zf.slider', function() {
  $('#sliderVolOutput').val(Number($('.slider-handle').attr('aria-valuenow')) - offset);
});

$('#sliderVolOutput').on('input', function() {
  $('#sliderVolOutputHidden').val(Number($('#sliderVolOutput').val()) + offset);
  $('#sliderVolOutputHidden').trigger('change');
});

</script>