@extends('layouts.adminapp')

@section('content')
<div class="container w-100 h-100">
    <div class="d-sm-none d-md-block">
        <div class="col-sm-12 pt-2">
            <div class="card border border-rounded border-info">
                <div class="card-header font-weight-bold bg-info h3">{{ __('Register Management Account') }}

                </div>
                <div class="card-body">
                    <form>
                        <label name="name" class="h5">Management Name</label><br/>
                        <input type="text" class="border-rounded w-50 pt-1 pb-1 justify-content-center"><br/><br/>
                        <label name="phone_no">Phone No.</label><br/>
                        <input type="text" class="border-rounded w-50 pt-1 pb-1"><br/><br/>
                        <label name="email">Email Address</label><br/>
                        <input type="email" class="border-rounded w-50 pt-1 pb-1"><br/><br/>
                        <div class="justify-content-center">
                            <input type="submit" class="border border-primary bg-primary text-white rounded p-2 h6">
                            <input type="reset" class="border border-info bg-info text-white rounded p-2 h6 ml-2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
