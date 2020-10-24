@extends('layouts.adminapp')

@section('content')
<div class="container w-100 h-100">
    <div class="d-sm-none d-md-block">
        <div class="col-sm-12 pt-2">
            <div class="card border border-rounded border-info">
                <div class="card-header font-weight-bold bg-info">{{ __('Register Management Account') }}

                </div>
                <div class="card-body">
                    <form>
                        <label name="name">Management Name</label><br/>
                        <input type="text"><br/><br/>
                        <label name="phone_no">Phone No.</label><br/>
                        <input type="text"><br/><br/>
                        <label name="email">Email Address</label><br/>
                        <input type="text"><br/><br/>
                        <div class="justify-content-center">
                            <input type="submit" class="border">
                            <input type="reset">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
