@extends('layouts.apex')
@section('title',"Product")



@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="content-header"> Product </div>
    </div>
</div>
<section id="configuration">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        
                    </div>
                </div>
                <div class="card-body collapse show">
                    <div class="row match-height">
                        <div class="col-lg-12 col-xl-12">
                            <div id="accordionWrap1" role="tablist" aria-multiselectable="true">
                                <div class="card collapse-icon accordion-icon-rotate">
                                   
                                   <form id="testform">
        Product Name: <input type="text" placeholder="name" id="name" name="name" required />
        <br /><br />
        QTY: <input type="number" placeholder="Enter Qty" id="qty" name="qty" required />
        <br /><br />
        Price: <input type="number" placeholder="Enter Price" id="price" name="price" required />
        <br />
        <br />
        <br />
        <button type="submit">Submit</button>
    </form>
	
                                    <div >
                                        <div class="card-body">
                                            <div class="card-block">
                                                <table class="table table-bordered">
                                                    <tbody >
														<tr >
                                                            <th  >name</td>
                                                            <th  >qty</td>
                                                            <th  >price</td>
                                                            <th  >Total value</td>
                                                            <th  >Created_at</td>
                                                            
                                                        </tr>
														 @php 
														 $totalPrice = 0;
														 @endphp
                                                         @foreach($data as $item)
                                                        <tr >
															@php 
															 $totalValue = floatval($item['price']) * floatval($item['qty']);	
															 $totalPrice += $totalValue;
															 @endphp
                                                            <td  >{{$item['name']}}</td>
                                                            <td  >{{$item['qty']}}</td>
                                                            <td  >{{$item['price']}}</td>
                                                            <td  >{{ $totalValue }}</td>
															<td  >{{$item['created_at']}}</td>
                                                            
                                                        </tr>
                                                        @endforeach
														
														<tr >
                                                            <th  ></td>
                                                            <th  ></td>
                                                            <th  ></td>
                                                            <th  > {{$totalPrice}}</td>
                                                            <th  ></td>
                                                            
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')

<script>
    $(document).ready(function() {
		$("#testform").submit(function (event) {
                event.preventDefault(); // Prevent page reload

                $.ajax({
                    url: "{{ url('product/add') }}",
                    type: "POST",
                    data: {
                        name: $("#name").val(), 
                        qty: $("#qty").val(), 
                        price: $("#price").val()
                    },
					headers: {
						"X-CSRF-TOKEN": "{{ csrf_token() }}"
					},
                    success: function (response) {
                        console.log(response);
                    },
                    error: function () {
                        console.log('Something went wrong!');
                    }
                });
            });
    });
</script>



@endpush