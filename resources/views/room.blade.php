@extends('base.layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/roomstyle.css') }}" >
@endpush
@section('content')
    <h1><a href="/rooms">Lokalen Beheren</a>  > Werkplekbeheer</h1>
    <a href="#">Trajectenbeheer</a>
    <a href="#">Mediëntenbeheer</a>
    <button type="button" data-toggle="modal" data-target="#createModal" class="btn btn-primary"><i class="fas fa-plus"></i> Nieuwe werkplek</button>
    <h2>{{ $room->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Nummer</th>
                <th>Omschrijving</th>
                <th>Systeem</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($room->workstations as $workstation)
                
                    <tr class="rowclick">
                        <td>{{ $workstation->id }}</td>
                        <td>{{ $workstation->number }}</td>
                        <td>{{ $workstation->description }}</td>
                        <td>{{ $workstation->system }}</td>
                        <td><button onclick="fillModifyModal({{ $workstation }})"type="button" data-toggle="modal" data-target="#modifyModal" class="btn btn-success"><i class="fas fa-pen"></i></button></td>
                        <td><button onclick="fillDeleteModal({{ $workstation->id }})" type="button" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                
            @endforeach
        </tbody>
    </table>

    {{-- modal voor nieuwe werkplek --}}
    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Nieuwe werkplek toevoegen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="nummer" class="col-form-label">Nummer</label>
                            <input type="text" class="form-control" id="nummer">
                            <span class="errorMsg" id="nummerError"></span>
                        </div>
                        <div class="form-group">
                            <label for="omschrijving" class="col-form-label">Omschrijving</label>
                            <input type="text" class="form-control" id="omschrijving">
                            <span class="errorMsg" id="omschrijvingError"></span>
                        </div>
                        <div class="form-group">
                            <label for="systeem" class="col-form-label">Systeem</label>
                            <input type="text" class="form-control" id="systeem">
                            <span class="errorMsg" id="systeemError"></span>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="makeWorkstation()" type="button" class="btn btn-primary"><i class="fas fa-check"></i> Toevoegen</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifyModalLabel">Werkplek aanpassen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="modalId" value="">
                        <div class="form-group">
                            <label for="nummer2" class="col-form-label">Nummer</label>
                            <input type="text" class="form-control" id="nummer2">
                            <span class="errorMsg" id="nummerError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="omschrijving2" class="col-form-label">Omschrijving</label>
                            <input type="text" class="form-control" id="omschrijving2">
                            <span class="errorMsg" id="omschrijvingError2"></span>
                        </div>
                        <div class="form-group">
                            <label for="systeem2" class="col-form-label">Systeem</label>
                            <input type="text" class="form-control" id="systeem2">
                            <span class="errorMsg" id="systeemError2"></span>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    <button onclick="modifyWorkstation()" type="button" class="btn btn-primary"><i class="fas fa-check"></i> Aanpassen</button>
                </div>
            </div>
        </div>
    </div>

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
              <p>Weet je zeker dat je deze werkplek wil verwijderen?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button onclick="deleteWorkstation()" type="button" class="btn btn-danger">Verwijderen</button>
            </div>
          </div>
        </div>
    </div>

    <script>
        let room_id = {{ $room->id }};
    </script>
@endsection

@push('scripts')
    <script src="{{asset('js/room.js')}}"></script>
@endpush


