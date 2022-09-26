<div class="row" style="margin:15px;" user_type="{{ $user->type }}" gold>

    <div class="col-3">
        <input style="text-align:center" class="form-control" disabled name="full_name" value='{{ $user->full_name }}'>
    </div>

    <div class="col-2">
        <input style="text-align:center" class="form-control" disabled name="phone" value={{ $user->phone }}>
    </div>

    <div class="col-3">
        <input style="text-align:center" class="form-control" disabled name="email" value={{ $user->email }}>
    </div>

    <div class="col-2">
        <input style="text-align:center" class="form-control" disabled value={{ $user->created_at }}>
    </div>

    <div id="type_val" class="col-1">
        <input style="text-align:center" class="form-control" disabled name="type" value={{ $user->type }}>
    </div>