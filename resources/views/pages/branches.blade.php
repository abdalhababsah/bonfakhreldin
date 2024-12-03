@extends('layout.mainlayout')

@section('title', __('Branches - Bonfkeralden'))

@section('content')

    <!-- Page Banner Section Start -->
    <div class="page-banner-section section">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Branches</li>
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
                        <h3>Our Branches</h3>
                        <input type="text" id="branch-search" placeholder="Search branches..." class="form-control mb-3">
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Include Leaflet.markercluster CSS and JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data for Branches
            var branches = [{
                    'name': 'Bonfkeralden Amman Branch 1',
                    'info': 'Located in the heart of Amman, near the city center.',
                    'lat': 31.9539,
                    'lng': 35.9106,
                    'city': 'Amman',
                    'address': '123 Main St, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 2',
                    'info': 'Situated in Abdoun neighborhood, popular for its upscale environment.',
                    'lat': 31.9454,
                    'lng': 35.8770,
                    'city': 'Amman',
                    'address': '456 Abdoun St, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 3',
                    'info': 'Located near the famous Rainbow Street, known for its vibrant culture.',
                    'lat': 31.9552,
                    'lng': 35.9335,
                    'city': 'Amman',
                    'address': '789 Rainbow St, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 4',
                    'info': 'In the heart of Jabal Al-Hussein, close to local markets.',
                    'lat': 31.9492,
                    'lng': 35.9204,
                    'city': 'Amman',
                    'address': '101 Jabal Al-Hussein St, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 5',
                    'info': 'Near the University of Jordan, catering to students and locals.',
                    'lat': 31.9486,
                    'lng': 35.9343,
                    'city': 'Amman',
                    'address': '202 University Rd, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 6',
                    'info': 'Located in the busy district of Al-Sweifieh, near commercial offices.',
                    'lat': 31.9767,
                    'lng': 35.8566,
                    'city': 'Amman',
                    'address': '303 Al-Sweifieh St, Amman',
                },
                {
                    'name': 'Bonfkeralden Madaba Branch 1',
                    'info': 'Near Madaba’s historical sites, attracting both locals and tourists.',
                    'lat': 31.7154,
                    'lng': 35.8031,
                    'city': 'Madaba',
                    'address': '400 Madaba Rd, Madaba',
                },
                {
                    'name': 'Bonfkeralden Madaba Branch 2',
                    'info': 'Close to the Mount Nebo area, with a scenic view of the Jordan Valley.',
                    'lat': 31.7225,
                    'lng': 35.7265,
                    'city': 'Madaba',
                    'address': '123 Mount Nebo Rd, Madaba',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 7',
                    'info': 'Located in the vibrant downtown of Amman.',
                    'lat': 31.9560,
                    'lng': 35.9337,
                    'city': 'Amman',
                    'address': '555 Downtown St, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 8',
                    'info': 'In the busy commercial district of Shmeisani, near many offices.',
                    'lat': 31.9712,
                    'lng': 35.9140,
                    'city': 'Amman',
                    'address': '888 Shmeisani St, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 9',
                    'info': 'Near the King Hussein Business Park, catering to professionals.',
                    'lat': 31.9800,
                    'lng': 35.8900,
                    'city': 'Amman',
                    'address': '234 King Hussein Business Park Rd, Amman',
                },
                {
                    'name': 'Bonfkeralden Amman Branch 10',
                    'info': 'Located in the Wadi Saqra area, close to shopping malls.',
                    'lat': 31.9614,
                    'lng': 35.8777,
                    'city': 'Amman',
                    'address': '999 Wadi Saqra St, Amman',
                }
            ];


            // Initialize the map
            var map = L.map('map').setView([31.9539, 35.9106], 8);

            // Add OpenStreetMap tiles
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Initialize marker cluster group
            var markers = L.markerClusterGroup();

            // Create an icon for branch markers (optional)
            // Replace 'path/to/branch-icon.png' with the actual path to your marker icon
            var branchIcon = L.icon({
                iconUrl: 'path/to/branch-icon.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
            });

            // Add markers to the cluster group
            branches.forEach(function(branch, index) {
                var marker = L.marker([branch.lat, branch
                .lng]); // , {icon: branchIcon} if you have a custom icon
                marker.bindPopup('<b>' + branch.name + '</b><br>' + branch.address);
                marker.on('click', function() {
                    // Update branch info panel (if needed)
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
        #map {
            width: 100%;
            height: 600px;
        }

        #branch-list {
            margin-top: 20px;
        }

        #branch-list-container {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
@endsection
