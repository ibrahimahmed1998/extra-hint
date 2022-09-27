<style>
    input{ text-align:center; }
</style>
<div class="row" style="margin:15px;" user_type="{{ $user->type }}" gold>

    <div class="col-1">
        <input style="width:75px;margin-left:-54%" class="form-control" disabled name="id" value='{{ $user->id }}'>
    </div>

    <div class="col-3">
        <input style="width:200px;margin-left:-16%" class="form-control" disabled name="full_name" value='{{ $user->full_name }}'>
    </div>

    <div class="col-2">
        <input style="width:140px;margin-left:-72%" class="form-control" disabled name="phone" value={{ $user->phone }}>
    </div>

    <div class="col-3">
        <input style="margin-left:-60%" class="form-control" disabled name="email" value={{ $user->email }}>
    </div>

    <div class="col-2">
        <input style="width:120px; margin-left:-83%" class="form-control" disabled value={{ $user->created_at }}>
    </div>

    <div id="type_val" class="col-1">
        <input style="margin-left:-258%" class="form-control" disabled name="type" value={{ $user->type }}>
    </div>