@extends('layouts.adminapp')

@section('content')

<div class="container w-100 h-100">
    <div class="d-sm-none d-md-block">
        <div class="col-sm-12 pt-2">
            <div class="card border border-rounded border-info">
                @foreach($details as $detail)
                <div class="card-header font-weight-bold bg-info h3">
                    {{ __($detail->user_id) }}
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('/images/'.$detail->image ) }}" width="200px" class="rounded"/>
                    </div>
                    <form method="POST" action="{{ route('admin.details.submit') }}" class="ml-5 mr-5 pl-5 pr-5 mt-3">
                        @csrf
                        @method('PUT')
                        <input type="hidden" value="{{$detail->user_id}}" name="id" id="id">
                        <div class="form-group ml-5 mr-5 pl-5 pr-5">
                            <label for="name" class="h4">Name</label><br/>
                            <input type="text" id="name" name="name" class="form-control border rounded border-secondary form-control-lg"><br/>
                        </div>
                        <div class="form-group ml-5 mr-5 pl-5 pr-5">
                            <label for="mobile_no" class="h4">Phone No.</label><br/>
                            <input type="text" id="mobile_no" name="mobile_no" class="form-control border rounded border-secondary form-control-lg"><br/>
                        </div>
                        <div class="form-group ml-5 mr-5 pl-5 pr-5">
                            <label for="email" class="h4">Email</label><br/>
                            <input type="email" id="email" name="email" class="form-control border rounded border-secondary form-control-lg">
                        </div>
                        <div class="form-group ml-5 mr-5 pl-5 pr-5">
                            <label for="status" class="h4">Status</label><br/>
                            <select class="form-control border rounded border-secondary form-control-lg" name="status">
                                <option value="0">Select Status:</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        @if($message = Session::get('message'))
                            <div class="text-center">
                                <h3 class="text-danger">{{$message}}</h3>
                            </div>
                        @endif
                        <div class="form-group text-center">
                            <input type="submit" class="border rounded bg-primary text-white h5 p-2 mr-2 mt-3">
                            <input type="reset" class="border rounded bg-info text-white h5 p-2 ml-2">
                        </div>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
