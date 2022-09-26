<form id="form2" action="/change_pass" method="POST" style="display:none;">
    @csrf
    <input required name="password" type="password" class="col-3" placeholder="please enter old password" /> <br> <br>
    <input required name="new_pass" type="password" class="col-3" placeholder="please enter new password" /> <br> <br>
    <input required name="conifrm_new_pass" type="password" class="col-3"
        placeholder="please re-enter new password" /><br><br>
    <button type="submit" class="btn btn-warning col-3"><b>Change Password ?</b></button>
</form>
    @include('error')
    
<a id="chngpass" href="#" class="btn btn-warning col-3"><b>Change Password ?</b></a>

<script>
    const btn = document.getElementById('chngpass');
    btn.addEventListener('click', () => {
        const form = document.getElementById('form2');
        btn.style.display = 'none';
        form.style.display = 'block';
    });
</script>
