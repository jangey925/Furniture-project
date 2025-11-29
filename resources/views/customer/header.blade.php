<div style="background-color: white; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); padding: 16px; display: flex; justify-content: space-between; align-items: center; border-radius: 8px;">
    <div style="flex: 1;"></div> 

    <div style="display: flex; align-items: center; gap: 16px; flex: 1; justify-content: flex-end;">
        @if(Auth::user()->profile_image)
            <img 
                src="{{ asset('storage/profile_images/' . Auth::user()->profile_image) }}" 
                alt="User Avatar" 
                style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover;">
        @else
            <!-- Default Initial (First Letter of Name) -->
            <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #e0e0e0; color: #4a4a4a; display: flex; justify-content: center; align-items: center; font-size: 14px; font-weight: bold;">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
        @endif
        <span style="color: #4a4a4a; font-size: 16px; font-weight: 500;">{{ Auth::user()->name }}</span>
    </div>
</div>
