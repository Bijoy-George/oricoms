<ul>
@foreach($childs as $child)
  <li>
      {{ $child->title }}
  @if(count($child->childs))
            @include('sub_cat',['childs' => $child->childs])
        @endif
  </li>
@endforeach
</ul>