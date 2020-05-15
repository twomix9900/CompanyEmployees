@if(Auth::user()->role === 'admin')
<!-- The admin user has full access to perform full  CRUD operations on both Companies and Employee -->
    <h5 style="text-align: center; color: green;">Admin View (debugging purpose)</h5>
@endif

@if(Auth::user()->role === 'employee')
<!-- Employees can only view (and edit) their own profile, and view the profile of other employees that belong to the same Company that they do. If an Employee tries to view any other route they should be redirect back to the previous page -->
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
    <h1 class="display-3">Employees</h1>    
  <table class="table table-striped">
    <thead>
        <tr>
          <td>First Name</td>
          <td>Last Name</td>
          <td>Email</td>
          <td>Company</td>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->company}}</td>
            <td>
                @if(Auth::user()->email === $employee->email || Auth::user()->role === 'admin')
                <a href="{{ route('employees.edit', $employee->id)}}" class="btn btn-primary">Edit</a>
                @endif
            </td>
            <td>
                @if(Auth::user()->role === 'admin')

                <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div>
  @if(Auth::user()->role === 'admin')
  <a style="margin: 19px;" href="{{ route('employees.create')}}" class="btn btn-primary">New employee</a>
  @endif
</div>  

@endsection