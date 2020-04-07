@extends('backend.layouts.master')

@section('title',__('tr.Show Buffets'))

@section('buffetssactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')

@php($langName = \Lang::getLocale().'_name')
<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Buffet') | {{ $category->name }}
                    </h3>
                </div>
            </div>

            
            <div style="padding:10px;">
                <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                    <thead>
                        <tr>
                            <th class="tdesign">#</th>
                            <th class="tdesign">@lang('tr.Name')</th>
                            <th class="tdesign">@lang('tr.No Members')</th>
                            <th class="tdesign">@lang('tr.Price')</th>
                            <th class="tdesign">@lang('tr.Image')</th>
                            <th class="tdesign">@lang('tr.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buffets as $index => $buffet)
                        <tr>
                            <td class="tdesign">{{ $index+1 }}</td>
                            <td class="tdesign">{{ $buffet->iteminventory->$langName }}</td>
                            <td class="tdesign">{{ $buffet->no_members }}</td>
                            <td class="tdesign">{{ $buffet->iteminventory->price.' '.$system_currency }}</td>
                            <td class="tdesign"><img src="{{ asset('uploads/itemsinventories/'.$buffet->iteminventory->inventory_image) }}" class="img-responsive" style="width:100px;"></td>
                            <td class="ttdesign">
                                
                                @can('delete_buffets')
                                <a onclick="return confirm('Are You Sure ?')" class="redbutton" href="{{ route('delete_item_buffets',$buffet->id) }}">@lang('tr.Delete')</a>
                                @endcan
                            </td>
                        </tr>
                
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="tdesign">#</th>
                            <th class="tdesign">@lang('tr.Name')</th>
                            <th class="tdesign">@lang('tr.No Members')</th>
                            <th class="tdesign">@lang('tr.Price')</th>
                            <th class="tdesign">@lang('tr.Image')</th>
                            <th class="tdesign">@lang('tr.Action')</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            
                


        </div>
    </div>
</div>


    
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>
@endsection