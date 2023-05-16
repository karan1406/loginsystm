<div class="form-group">
  <label for="{{$name}}">{{$title}}</label>
  <textarea class="form-control" name="{{$name}}" id="{{$id}}" rows="3" placeholder="{{$placeholder}}"> {{ $slot ?? old('$name')}}</textarea>
</div>