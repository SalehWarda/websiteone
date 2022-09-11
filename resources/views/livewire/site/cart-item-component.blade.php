
@if($cartItem->model->name)

    <tr  x-data="{ show: true }" x-show="show" >
        <td class="product-thumbnail"><a href="{{route('site.service-details',$cartItem->model->slug)}}">
                <img src="{{ asset('assets/images/admin/services/' . $cartItem->model->firstMedia->file_name) }}" alt="{{$cartItem->model->name}}"></a></td>
        <td class="product-name"><a href="{{route('site.service-details',$cartItem->model->slug)}}">{{$cartItem->model->name}}</a></td>
        <td class="product-price"><span class="amount">{{trans('site.SR')}} {{$cartItem->model->price}}</span></td>

        <td class="product-subtotal"><span class="amount">{{trans('site.SR')}} {{$cartItem->model->price * $cartItem->qty}}</span></td>
        <td class="product-remove">
            <a wire:click.prevent="removeFromCart('{{ $cartItem->rowId }}')" x-on:click="show = false" class="btn btn-link" ><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endif

@if($cartItem->model->title)
    <tr  x-data="{ show: true }" x-show="show" >
        <td class="product-thumbnail"><a href="{{route('site.course-details',$cartItem->model->slug)}}">
                <img src="{{ asset('assets/images/admin/courses/' . $cartItem->model->firstMedia->file_name) }}" alt="{{$cartItem->model->title}}"></a></td>
        <td class="product-name"><a href="{{route('site.course-details',$cartItem->model->slug)}}">{{$cartItem->model->title}}</a></td>
        <td class="product-price"><span class="amount">{{trans('site.SR')}} {{$cartItem->model->price}}</span></td>

        <td class="product-subtotal"><span class="amount">{{trans('site.SR')}} {{$cartItem->model->price * $cartItem->qty}}</span></td>
        <td class="product-remove">
            <a wire:click.prevent="removeFromCart('{{ $cartItem->rowId }}')" x-on:click="show = false" class="btn btn-link" ><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endif




