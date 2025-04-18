@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    
    <div class="card-body">
        <form method="POST" action="{{ url('/level') }}" class="form-horizontal">
            @csrf
            
            <!-- Level Code (Select Dropdown) -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Level Code</label>
                <div class="col-10">
                    <select class="form-control" id="level_code" name="level_code" required>
                        <option value="">- Pilih Level Code -</option>
                        <option value="L1" {{ old('level_code') == 'L1' ? 'selected' : '' }}>Level 1</option>
                        <option value="L2" {{ old('level_code') == 'L2' ? 'selected' : '' }}>Level 2</option>
                        <option value="L3" {{ old('level_code') == 'L3' ? 'selected' : '' }}>Level 3</option>
                        <option value="L4" {{ old('level_code') == 'L4' ? 'selected' : '' }}>Level 4</option>
                    </select>
                    @error('level_code')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Level Name -->
            <div class="form-group row">
                <label class="col-2 col-form-label">Level Name</label>
                <div class="col-10">
                    <input type="text" class="form-control" id="level_name" name="level_name" value="{{ old('level_name') }}" required>
                    @error('level_name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                    <a class="btn btn-sm btn-secondary ml-1" href="{{ url('level') }}">Return</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection