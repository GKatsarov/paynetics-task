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
                    Project
                </th>
                <th scope="col" class="px-6 py-3">
                    Duration
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr class="bg-white border-b">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $task->title }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $task->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->status }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $task->project->title }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\CarbonInterval::minutes($task->duration)->cascade()->forHumans() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="5" class="px-6 py-4">
                    {{ $tasks->links() }}
                </td>
            </tfoot>

        </table>
    </div>

</x-main-layout>
