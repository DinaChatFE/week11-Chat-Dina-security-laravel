@extends('layouts.app')
@section('content')



<div class="container-md">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5> Create New Categories</h5>
                </div>
                <div class="card-body">
                    <form method="POST"  action="{{ route('categories.create') }}" >
                      @csrf
                        <label for="title" class="form-label" >Title of categies</label>
                        <input type="text" required id="title" class="form-control" name="title" placeholder="title">
                        <input type="submit" class="btn btn-primary mt-2" value="Create New categories">
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>All Categories</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">title</th>
                            <th scope="col">action</th>                       
                          </tr>
                        </thead>
                        <tbody>
                         
                          @foreach ($categories as $category )
                          <tr>
                            <th scope="row">{{$loop->index + 1}}</th>
                            <td>{{$category->title}}</td>
                            <td >
                              <form action="{{route('categories.destroy' , $category->id)}}" method="POST" >
                                @csrf
                                <input class="btn btn-danger" value="Delete" type="submit" />  
                              </form>
                            </td>                   
                          </tr>                    
                          @endforeach                
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection