@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b style="color:red">FORBIDDEN ACCESS</b></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <b style="color:red">Please contact the MIS Office at mis@addu.edu.ph.</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
