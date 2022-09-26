@include('Serivce._headerfooter._hstudent')
@include('Serivce._user_nav')
<div style="margin:3%">

    <div class="row">
        @include('Serivce.lists.user_fields')
    </div>

    <form action="/user_update/{{$user->id}}" method="POST">
        @csrf
        @include('Serivce.lists.user_fields_values')
        @include('Serivce.student_area')
        <br><br>
        <div id="update-btn" style="display: none" class="col-2">
            <button type="submit" class="btn btn-info">Make Update !</a>
        </div>
    </form>
    @include('error')


</div>
@include('Serivce._headerfooter._fstudent')</body>