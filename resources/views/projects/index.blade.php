<x-main-layout>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Duration
                </th>
                <th scope="col" class="px-6 py-3">
                    Tasks
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($projects as $project)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $project->title }}</th>
                    <td class="px-6 py-4">{{ $project->description }}</td>
                    <td class="px-6 py-4">{{ $project->status }}</td>
                    <td class="px-6 py-4">{{ \Carbon\CarbonInterval::minutes($project->duration)->cascade()->forHumans() }}</td>
                    <td class="px-6 py-4">{{ $project->tasks()->count() }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{route('projects.tasks.index',$project->id)}}" class="font-medium text-blue-600 hover:underline">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="px-6 py-4">
                    {{ $projects->links() }}
                </td>
            </tfoot>

        </table>
    </div>

</x-main-layout>
