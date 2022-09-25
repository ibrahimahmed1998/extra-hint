<div style="display:none" id="profile" kind="subdiv">
    <div class="row">
        <div class="col col2">first name:</div>
        <div class="col col2">last name:</div>
        <div class="col col2">phone:</div>
        <div class="col col2">email:</div>
        <div class="col col2">type:</div>
    </div>
        <div class="row">
            <div class="col">
                <input class="form-control col2" disabled value={{ $user->first_name }}>
            </div>
            <div class="col">
                <input class="form-control col2" disabled value={{ $user->last_name }}>
            </div>
            <div class="col">
                <input class="form-control col2" disabled value={{ $user->phone }}>
            </div>
            <div class="col">
                <input class="form-control col2" disabled value={{ $user->email }}>
            </div>
            <div class="col"><input class="form-control col2" disabled value={{ $type }}></div>
        </div>

        <br><br><br>

        <form id="form2" action="/change_pass" method="POST" style="display:none;">
            <input required name="password" type="password" class="col-3" placeholder="please enter old password" /> <br> <br>
            <input required name="new_pass" type="password" class="col-3" placeholder="please enter new password" /> <br> <br>
            <input required name="conifrm_new_pass" type="password" class="col-3" placeholder="please re-enter new password" /><br><br>
            <button type="submit" class="btn btn-warning col-2"><b>Change Password ?</b></button>
        </form>

        <a id="chngpass" href="#" class="btn btn-warning col-2"><b>Change Password ?</b></a>

        <script>
            const btn = document.getElementById('chngpass');
            btn.addEventListener('click', ()=>{
                const form = document.getElementById('form2');
                btn.style.display = 'none';
                form.style.display ='block';
                });
        </script>
</div>
