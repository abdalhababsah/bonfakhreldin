@extends('layout.mainlayout')

@section('title', __('Branches - Bonfkeralden'))

@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                <li>{{ __('header.branches') }}</li>
            </ul>
        </div>
    </div>
    <!-- Page Banner Section End -->

    <!-- Branches Section Start -->
    <div class="branches-section section section-padding pt-0">
        <div class="container">
            <div class="row mt-4">
                <!-- Map Container -->
                <div class="col-md-8">
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </div>
                <!-- Branch List -->
                <div class="col-md-4">
                    <div id="branch-list">
                        <h3>{{ __('header.branches') }}</h3>
                        <input type="text" id="branch-search" placeholder="{{ __('Search branches...') }}"
                            class="form-control mb-3">
                        <!-- Scrollable Branches List -->
                        <div id="branch-list-container">
                            <ul id="branches" class="list-group">
                                <!-- Branch items will be inserted here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Branches Section End -->
    <!-- Include Leaflet.js CSS and JavaScript -->
    <link rel="stylesheet" href="{{ asset('assets/dist-leaflet/leaflet.css') }}" />
    <script src="{{ asset('assets/dist-leaflet/leaflet.js') }}"></script>
    <!-- Include Leaflet.markercluster CSS and JS -->
    <link rel="stylesheet" href="{{ asset('assets/dist-leaflet/MarkerCluster.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/dist-leaflet/MarkerCluster.Default.css') }}" />
    <script src="{{ asset('assets/dist-leaflet/leaflet.markercluster.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Branches (localized dynamically)
            var branches = @json(__('branches.branches'));

            // Initialize the map
            var map = L.map('map').setView([31.9539, 35.9106], 8);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Initialize marker cluster group
            var markers = L.markerClusterGroup();

            // Add markers to the cluster group
            branches.forEach(function(branch, index) {
                var googleMapsLink =
                    `https://www.google.com/maps/search/?api=1&query=${branch.lat},${branch.lng}`;
                var popupContent = `
                    <div>
                        <h5>${branch.name}</h5>
                        <a href="${googleMapsLink}" target="_blank">View on Google Maps</a>
                    </div>
                `;

                var marker = L.marker([branch.lat, branch.lng]);
                marker.bindPopup(popupContent);
                marker.on('click', function() {
                    // Highlight the corresponding branch in the list
                    highlightBranchInList(index);
                });
                markers.addLayer(marker);

                // Add branch to the list
                var branchItem = document.createElement('li');
                branchItem.className = 'list-group-item';
                branchItem.textContent = branch.name;
                branchItem.setAttribute('data-index', index);
                branchItem.style.cursor = 'pointer';
                branchItem.addEventListener('click', function() {
                    map.setView([branch.lat, branch.lng], 15);
                    marker.openPopup();
                });
                document.getElementById('branches').appendChild(branchItem);
            });

            map.addLayer(markers);

            // Implement search functionality
            document.getElementById('branch-search').addEventListener('input', function() {
                var searchQuery = this.value.toLowerCase();
                var branchItems = document.querySelectorAll('#branches li');
                branchItems.forEach(function(item) {
                    var branchName = item.textContent.toLowerCase();
                    if (branchName.indexOf(searchQuery) !== -1) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });


        });
    </script>

    <style>

    </style>
@endsection
