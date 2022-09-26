

@isset($msg)

<div id="popUpMain" style="display: none;">
    <div id="popup">
      <h1 id="newsHeading">Join</h1>
      <a href="#linkHere" target="_blank"><button class="buttonNews">More Info</button></a>
      <button class="buttonNews">No Thanks</button>
    </div>
  </div>

    <div>
        <b>tttttttttttttttttttttttttttttttttes</b>
    </div>
@endisset

<script>
    $(document).ready(function(){
        setTimeout(function(){
        $('#popUpMain').css('display', 'block'); }, 3000);
    });
  
    $('.buttonNews').click(function(){
      $('#popUpMain').css('display', 'none')
    });
  </script>



