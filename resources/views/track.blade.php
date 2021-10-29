@extends('base.layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trackstyle.css') }}" >
@endpush

@section('content')
    {{-- navigatie --}}
    @foreach ($tracks as $trk)
        @if($trk->isActive)
            <a href="/track/{{ $trk->id }}" class="@if ($trk->id == $track->id) active @endif">{{ $trk->name }}</a>    
        @endif
    @endforeach

    <h1>Weekrooster {{ $track->name }}</h1>
    <button type="button" data-toggle="modal" data-target="#printModal" class="btn btn-primary"><i class="fas fa-print"></i> Print Rooster</button>
    @foreach ($rooms as $room)
    <table id="room-ochtend-{{ $room->id }}">
       
        <thead>
            @if ($loop->first)
            <tr>
                <th>Ochtend</th>
                <th>Maandag</th>
                <th>Dinsdag</th>
                <th>Woensdag</th>
                <th>Donderdag</th>
                <th>Vrijdag</th>
            </tr>
            @endif
            <tr>
                <th>{{ $room->name }}</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($room->workstations as $workstation)
            <tr id="workstation-ochtend-{{ $workstation->id }}">
                <td>{{ $room->abbreviation }}-{{ $workstation->number }}</td>
                <td id="ochtend-maandag-{{ $workstation->id }}"></td>
                <td id="ochtend-dinsdag-{{ $workstation->id }}"></td>
                <td id="ochtend-woensdag-{{ $workstation->id }}"></td>
                <td id="ochtend-donderdag-{{ $workstation->id }}"></td>
                <td id="ochtend-vrijdag-{{ $workstation->id }}"></td>
            </tr>
            @endforeach
        </tbody>

    </table>
    
    @endforeach
    @foreach($rooms as $room)
    <table id="room-middag-{{ $room->id }}">
        <thead>
            @if ($loop->first)
            <tr>
                <th>Middag</th>
                <th>Maandag</th>
                <th>Dinsdag</th>
                <th>Woensdag</th>
                <th>Donderdag</th>
                <th>Vrijdag</th>
            </tr>
            @endif
            <tr>
                <th>{{ $room->name }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room->workstations as $workstation)
            <tr id="workstation-middag-{{ $workstation->id }}">
                <td>{{ $room->abbreviation }}-{{ $workstation->number }}</td>
                <td id="middag-maandag-{{ $workstation->id }}"></td>
                <td id="middag-dinsdag-{{ $workstation->id }}"></td>
                <td id="middag-woensdag-{{ $workstation->id }}"></td>
                <td id="middag-donderdag-{{ $workstation->id }}"></td>
                <td id="middag-vrijdag-{{ $workstation->id }}"></td>
            </tr>
            @endforeach
        </tbody>

    </table>
    @endforeach
    <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="trackModalLabel">Aanpassen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="medients" class="col-form-label">Selecteer een medient</label>
                    <select class="form-select" aria-label="medients" id="medients">
                        <option value="0">Vrij</option>
                        @foreach($medients as $medient)
                        <option value="{{ $medient->id }}">{{ $medient->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="startsLater">
                    <label class="form-check-label" for="startsLater">Start later</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="endsEarlier">
                    <label class="form-check-label" for="endsEarlier">Stopt eerder</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="reserved">
                    <label class="form-check-label" for="reserved">Reserveren</label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="turnOff">
                    <label class="form-check-label" for="turnOff">Uitschakelen</label>
                </div>
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
              <button onclick="sendData()" type="button" class="btn btn-danger">Opslaan</button>
            </div>
          </div>
        </div>
    </div>
    <script>
        let workstations = @json($workstations);
        let rooms = @json($rooms);
        let medients = @json($medients);
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('js/track.js') }}"></script>
@endpush
