<x-mail::message>
# Introduction

Thanks for subscribe !!!

<x-mail::button :url="route('frontend.index')">
    Visit our Website
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
