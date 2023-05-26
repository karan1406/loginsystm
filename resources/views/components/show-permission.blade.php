{{-- @dd($permissions) --}}
<div class="hstack gap-5">
    @foreach ($permissions as $permission)
        @if (Str::contains($permission, $find))

            <div class="form-check pl-5">
                <input class="form-check-input check" name="permission" type="checkbox" value="{{ $permission->name }}"
                    id="{{ $permission->id }}"
                    @if($page == 'edit page')
                        @foreach ($rolePermission as $role)
                            {{ $role->name == $permission->name ? 'checked' : '' }}
                        @endforeach
                    @endif>
                <label class="form-check-label" for="{{ $permission->id }}">
                    {{ $permission->name }}
                </label>
            </div>
        @endif
    @endforeach
</div>
