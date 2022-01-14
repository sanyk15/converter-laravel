@extends('layouts.main')

@section('content-body')
    <div class="container mt-5">
        <form action="{{ route('index') }}" method="GET">
            <div class="row">
                <div class="col-auto">
                    <h3>From</h3>
                </div>
                <div class="col-auto">
                    <select class="form-control" name="from">
                        @foreach($currencies as $currency)
                            <option
                                value="{{ $currency->slug }}"
                                @if(request('from') == $currency->slug) selected @endif
                            >
                                {{ strtoupper($currency->slug) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto text-center">
                    <h3>To</h3>
                </div>
                <div class="col-auto">
                    <select class="form-control" name="to">
                        @foreach($currencies as $currency)
                            <option
                                value="{{ $currency->slug }}"
                                @if(request('to') == $currency->slug) selected @endif
                            >
                                {{ strtoupper($currency->slug) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <h3>Amount</h3>
                </div>
                <div class="col-auto">
                    <input class="form-control" name="amount" value="{{ request('amount') }}">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-success">OK</button>
                </div>
            </div>
        </form>
        @if(isset($result))
            <div class="row mt-2">
                <h3>Result: {{ $result }}</h3>
            </div>
        @endif
    </div>
@endsection
