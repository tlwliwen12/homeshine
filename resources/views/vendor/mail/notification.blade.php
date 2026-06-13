@component('mail::message')

# {{ $title ?? 'Notification' }}

Hello {{ $name ?? 'User' }},

{{ $message }}

@if(!empty($details))
---

## 📌 Details
@foreach($details as $key => $value)
- **{{ $key }}:** {{ $value }}
@endforeach
@endif

@if(!empty($url))
@component('mail::button', ['url' => $url])
View Details
@endcomponent
@endif

---

Thanks,
**HomeShine Team 💚**

@endcomponent
