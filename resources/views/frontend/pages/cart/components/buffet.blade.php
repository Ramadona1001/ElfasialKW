@php($buffet = \App\Buffet::findOrfail($item->id))
    <div class="col-lg-2">
        <div class="product">
            <figure class="product-image">
              <a href="{{ route('frontend_services_single_buffets',$buffet->id) }}"><img src="{{ asset('uploads/itemsinventories/'.$buffet->iteminventory->inventory_image) }}" style="width: 100%; height: 200px;" alt=""></a>
            </figure>
            
            <div style="border: 1px dashed #f05f79;padding:15px;">
              <p style="margin-bottom: 0;">{{ $item->name }}</p>
              <p style="margin-bottom: 0;">@lang('tr.Price'): {{ $item->price.' '.$system_currency }}</p>
              <p style="margin-bottom: 0;">
                <form action="{{ route('cart_update',$item->rowId) }}" method="post">
                @csrf
                <input type="number" name="quantity" style="color: #848484; border: 1px solid; padding: 5px; width: 100%; margin-right: 18px; text-align: center; font-weight: bold;" class="form-control input-number" value="{{ $item->qty }}" min="1" required readonly>
                {{-- <button type="submit" class="btn btn-primary" style="background: transparent; color: #f05f79; border: 1px solid;"><i class="fa fa-edit" ></i></button> --}}
                </form>
              </p>
              <hr>
              <a href="{{ route('cart_remove',$item->rowId) }}" style="background: transparent; color: #f05f79; border: 1px solid;" onclick="return confirm('tr.Are You Sure ?')" class="btn btn-primary col-12"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    </div>