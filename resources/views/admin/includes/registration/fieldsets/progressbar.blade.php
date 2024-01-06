<ul id="progressbar">
    <li class="active"
        style="@if ($lang == 'en') float: left;  @else   float: right; @endif"
        id="account"><strong>{{ __('messages.account') }}</strong></li>

    <li id="personal"
        style="@if ($lang == 'en') float: left;  @else   float: right; @endif">
        <strong>{{ __('messages.personal') }}</strong>
    </li>
    <li id="personal"
        style="@if ($lang == 'en') float: left;  @else   float: right; @endif">
        <strong>{{ __('messages.company') }} </strong>
    </li>
    <li id="confirm"
        style="@if ($lang == 'en') float: left;  @else   float: right; @endif">
        <strong>{{ __('messages.finish') }}</strong>

    </li>
</ul>
