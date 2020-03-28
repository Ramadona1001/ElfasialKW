@extends('backend.layouts.master')

@section('title',__('tr.Show Contract'))

@section('contractsactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1" style="padding:10px;">
                        <p>@lang('tr.English Name'): {{ $contract->en_name }}</p>
                        <p>@lang('tr.Arabic Name'): {{ $contract->ar_name }}</p>
                        <p>@lang('tr.Arabic Content'): {!! $contract->ar_content !!}</p>
                        <p>@lang('tr.English Content'): {!! $contract->ar_content !!}</p>

                </div>


                
            </div>

            <hr>


            <table class="table table-responsive table-bordered" style="width:100%;padding:15px;">
                <thead>
                    <th style="width:13%">#</th>
                    <th style="width:80%">@lang('tr.Name')</th>
                    <th>@lang('tr.Action')</th>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            @can('show_contracts')
                            <td>
                                <a href="{{ route('terms_show',$item->id) }}">{{ $item->terms($item->terms_id)->name }}</a>
                            </td>
                            @endcan
                            <td>
                                @php($termsContract = [$contract->id,$item->id])
                                <a href="{{ route('terms_show',implode(',',$termsContract)) }}" style="color:red;"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('javascript')




@endsection