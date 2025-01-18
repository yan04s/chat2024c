<style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style>
<table class="min-w-full divide-y divide-gray-200" style="border: 1px solid black;border-collapse: collapse;">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Sender
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Receiver
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Text
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Images
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Schedule Time
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Create Time
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <!-- Example row -->
         @foreach ($messages as $m)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $m->sender->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $m->receiver->name }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $m->text }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><!-- style="justify-content: center;align-items: center;text-align: center;" -->
                @foreach ($m->images as $index => $image)
                    @if (count($m->images) == 1 || (($index % 2) == 0 && $index > 0))
                        <div style="width: 10.25rem;">
                    @elseif (count($m->images) > 1 && ($index % 2) == 0 && $index == 0)
                        <div style="width: 10.25rem;margin-top: 1rem;">
                    @endif
                        <img src="{{ $imageDisplayPath }}{{ $image }}" alt="Image" style="width: 5rem;">
                    @if (($index % 2) == 1)
                        </div>
                    @endif
                @endforeach
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $m->scheduleAt ? $m->scheduleAt : 'N/A' }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ $m->created_at }}
            </td>
        </tr>
        @endforeach
        <!-- More rows... -->
    </tbody>
</table>