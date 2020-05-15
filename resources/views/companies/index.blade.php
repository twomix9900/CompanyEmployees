@include('flash-message')
@yield('content')

@if(Auth::user()->role === 'admin')
<!-- The admin user has full access to perform full  CRUD operations on both Companies and Employee -->
    <h5 style="text-align: center; color: green;">Admin View (debugging purpose)</h5>
@endif

@if(Auth::user()->role === 'company')
<!-- Employees can only view (and edit) their own profile, and view the profile of other companies that belong to the same Company that they do. If an Employee tries to view any other route they should be redirect back to the previous page -->
    <h5 style="text-align: center; color: green;">Employee View (debugging purpose)</h5>
@endif

@extends('base')
@extends('layouts.app')

@section('main')

<div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div>
  @endif
</div>

<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Companies</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Website</td>
          <td>Logo</td>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        @if(Auth::user()->role === 'admin' || Auth::user()->company()->first()->company === $company->company)
        <tr>
            <td>{{$company->id}}</td>
            <td>{{$company->name}}</td>
            <td>{{$company->website}}</td>
            <td>
              <img src="{{asset('/storage/'.$company->logo)}}" style="max-width: 100; max-height: 100;" alt="" />
            </td>
            <td>
                @if(Auth::user()->role === 'admin' || Auth::user()->email === $company->email)
                <a href="{{ route('companies.edit', $company->id)}}" class="btn btn-primary">Edit</a>
                @endif
            </td>
            <td>
                @if(Auth::user()->role === 'admin')

                <form action="{{ route('companies.destroy', $company->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
  </table>
  {{ $companies->links() }}	
  <div>
  @if(Auth::user()->role === 'admin')
  <a style="margin: 19px;" href="{{ route('companies.create')}}" class="btn btn-primary">New company</a>
  @endif
</div>  

@endsection