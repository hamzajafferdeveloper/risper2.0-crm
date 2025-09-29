@extends('layouts.adminSettingLayout')

@section('content-settings')
    <div class="card-body p-6">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li role="presentation">
                    <button class="inline-block px-4 py-2.5 font-semibold border-b-2 rounded-t-lg" id="default-home-tab"
                        data-tabs-target="#default-home" type="button" role="tab" aria-controls="default-home"
                        aria-selected="false">Home</button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block px-4 py-2.5 font-semibold border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="default-details-tab" data-tabs-target="#default-details" type="button" role="tab"
                        aria-controls="default-details" aria-selected="false">Details</button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block px-4 py-2.5 font-semibold border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="default-profile-tab" data-tabs-target="#default-profile" type="button" role="tab"
                        aria-controls="default-profile" aria-selected="false">Profile</button>
                </li>
                <li role="presentation">
                    <button
                        class="inline-block px-4 py-2.5 font-semibold border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="default-settings-tab" data-tabs-target="#default-settings" type="button" role="tab"
                        aria-controls="default-settings" aria-selected="false">Settings</button>
                </li>
            </ul>
        </div>
        <div id="default-tab-content">
            <div id="default-home" role="tabpanel" aria-labelledby="default-home-tab">
                <h6 class="text-lg mb-2">Title Home</h6>
                <p class="text-secondary-light mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1400s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not </p>
                <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets
                    containing Lorem Ipsum passages, and more recently with desktop</p>
            </div>
            <div id="default-details" role="tabpanel" aria-labelledby="default-details-tab">
                <h6 class="text-lg mb-2">Title Details</h6>
                <p class="text-secondary-light mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1400s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not </p>
                <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets
                    containing Lorem Ipsum passages, and more recently with desktop</p>
            </div>
            <div id="default-profile" role="tabpanel" aria-labelledby="default-profile-tab">
                <h6 class="text-lg mb-2">Title Profile</h6>
                <p class="text-secondary-light mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1400s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not </p>
                <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets
                    containing Lorem Ipsum passages, and more recently with desktop</p>
            </div>
            <div id="default-settings" role="tabpanel" aria-labelledby="default-settings-tab">
                <h6 class="text-lg mb-2">Title Settings</h6>
                <p class="text-secondary-light mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1400s, when an
                    unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived
                    not </p>
                <p class="text-secondary-light mb-0">It was popularised in the 1960s with the release of Letraset sheets
                    containing Lorem Ipsum passages, and more recently with desktop</p>
            </div>
        </div>
    </div>
@endsection
