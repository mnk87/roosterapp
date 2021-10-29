@extends('base.layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/roomsstyle.css') }}" >
@endpush
@section('content')
    <h1>Lokalen Beheren</h1>
    <a href="#">Trajectenbeheer</a>
    <a href="#">Mediëntenbeheer</a>
    <button type="button" data-toggle="modal" data-target="#roomModal" class="btn btn-primary"><i class="fas fa-plus"></i> Nieuw Lokaal</button>

    <table class="no-spacing">
        <thead>
            <tr>
                <th>Nr.</th>
                <th>Lokaal</th>
                <th>Afkorting</th>
                <th>Traject</th>
                <th>Werkplekken</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                
                    <tr class="rowclick">
                        <td onclick="window.location='room/{{ $room->id }}';">{{ $room->number }}</td>
                        <td onclick="window.location='room/{{ $room->id }}';">{{ $room->name }}</td>
                        <td onclick="window.location='room/{{ $room->id }}';">{{ $room->abbreviation }}</td>
                        <td onclick="window.location='room/{{ $room->id }}';">{{ $room->track->name }}</td>
                        <td onclick="window.location='room/{{ $room->id }}';">{{ $room->workstations->count() }}</td>
                        <td><button onclick="fillModifyModal({{ $room }})" type="button" data-toggle="modal" data-target="#room2Modal" class="btn btn-success"><i class="fas fa-pen"></i></button></td>
                        <td><button onclick="fillDeleteModal({{ $room->id }})" type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                
            @endforeach
        </tbody>
    </table>

    {{-- modal voor nieuw lokaal --}}
    <div class="modal fade" id="roomModal" tabindex="-1" role="dialog" aria-labelledby="roomModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomModalLabel">Nieuw lokaal toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="lokaalnummer" class="col-form-label">Lokaalnummer</label>
                            <input type="text" class="form-control" id="lokaalnummer">
                            <span class="errorMsg" id="lokaalnummerError"></span>
                        </div>
                        <div class="form-group">
                            <label for="lokaalnaam" class="col-form-label">Lokaalnaam</label>
                            <input type="text" class="form-control" id="lokaalnaam">
                            <span class="errorMsg" id="lokaalnaamError"></span>
                        </div>
                        <div class="form-group">
                            <label for="afkorting" class="col-form-label">Afkorting</label>
                            <input type="text" class="form-control" id="afkorting">
                            <span class="errorMsg" id="lokaalafkortingError"></span>
                        </div>
                        <div class="form-group">
                            <label for="traject" class="col-form-label">Traject</label>
                            <select class="form-select" aria-label="traject" id="traject">
                                @foreach($tracks as $track)
                                <option value="{{ $track->id }}">{{ $track->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="makeRoom()" type="button" class="btn btn-primary"><i class="fas fa-check"></i> Toevoegen</button>
                </div>
            </div>
        </div>
    </div>
    {{-- einde modal voor nieuw lokaal --}}
    {{-- modal voor aanpassen lokaal --}}
    <div class="modal fade" id="room2Modal" tabindex="-1" role="dialog" aria-labelledby="room2ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="room2ModalLabel">Lokaal aanpassen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="modalId" value="">
                        <div class="form-group">
                            <label for="lokaalnummer2" class="col-form-label">Lokaalnummer</label>
                            <input type="text" class="form-control" id="lokaalnummer2">
                            <span class="errorMsg" id="lokaalnummerError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="lokaalnaam2" class="col-form-label">Lokaalnaam</label>
                            <input type="text" class="form-control" id="lokaalnaam2">
                            <span class="errorMsg" id="lokaalnaamError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="afkorting2" class="col-form-label">Afkorting</label>
                            <input type="text" class="form-control" id="afkorting2">
                            <span class="errorMsg" id="lokaalafkortingError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="traject2" class="col-form-label">Traject</label>
                            <select class="form-select" aria-label="traject2" id="traject2">
                                <option id="currentOption" value=""></option>
                                @foreach($tracks as $track)
                                <option value="{{ $track->id }}">{{ $track->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="modifyRoom()" type="button" class="btn btn-primary"><i class="fas fa-check"></i> Aanpassen</button>
                </div>
            </div>
        </div>
    </div>
    {{-- einde modal voor aanpassen lokaal --}}
    {{-- modal voor verwijderen --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Verwijder</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="deleteModalId">
              <p>Weet je zeker dat je dit lokaal wil verwijderen?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button onclick="deleteRoom()" type="button" class="btn btn-danger">Verwijderen</button>
            </div>
          </div>
        </div>
    </div>
    {{-- einde modal voor verwijderen --}}      
@endsection

@push('scripts')
    <script src="js/rooms.js"></script>
@endpush
