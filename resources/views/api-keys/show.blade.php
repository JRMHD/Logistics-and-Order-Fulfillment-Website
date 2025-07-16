@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 1rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            @if (session('success'))
                <div
                    style="background: #dcfce7; color: #166534; padding: 1rem; border-radius: 0.75rem; border-left: 4px solid #22c55e; margin-bottom: 1.5rem; box-shadow: 0 4px 10px rgba(34, 197, 94, 0.1);">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0;" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Page Header -->
            <div class="page-header"
                style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 1rem; min-width: 0; flex: 1;">
                    <a href="{{ route('api-keys.index') }}"
                        style="text-decoration: none; padding: 0.75rem; border-radius: 50%; background: rgba(255, 255, 255, 0.8); border: 1px solid #e2e8f0; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center; flex-shrink: 0;"
                        onmouseover="this.style.background='white'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';"
                        onmouseout="this.style.background='rgba(255, 255, 255, 0.8)'; this.style.boxShadow='none';">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #6b7280;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div style="display: flex; align-items: center; gap: 1rem; min-width: 0; flex: 1;">
                        <div
                            style="width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #ED1C24, #c41e3a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(237, 28, 36, 0.4); flex-shrink: 0;">
                            <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1721 9z" />
                            </svg>
                        </div>
                        <div style="min-width: 0; flex: 1;">
                            <h1 class="page-title"
                                style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0; word-break: break-word;">
                                {{ $apiKey->name }}
                            </h1>
                            <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">API Key Details and Configuration</p>
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <a href="{{ route('api-keys.edit', $apiKey) }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #f59e0b, #d97706); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); white-space: nowrap;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(245, 158, 11, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                </div>
            </div>

            <!-- API Key Display & Quick Actions -->
            <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div class="api-grid" style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                    <!-- API Key Display -->
                    <div
                        style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div
                                style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div style="min-width: 0; flex: 1;">
                                <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">API Key</h3>
                                <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">Your secure access token</p>
                            </div>
                        </div>

                        <div style="position: relative;">
                            <input type="password" id="apiKeyValue" value="{{ $apiKey->key }}" readonly
                                style="width: 100%; border: 1px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem; padding-right: 7rem; font-size: 0.875rem; background: #f8fafc; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; box-sizing: border-box; min-width: 0;">
                            <div class="api-key-actions"
                                style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); display: flex; gap: 0.5rem;">
                                <button onclick="toggleApiKeyVisibility()" title="Toggle Visibility"
                                    style="padding: 0.5rem; border-radius: 0.5rem; background: #374151; color: white; border: none; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center;"
                                    onmouseover="this.style.background='#1f2937'"
                                    onmouseout="this.style.background='#374151'">
                                    <svg id="toggleIcon" style="width: 1.25rem; height: 1.25rem;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <button onclick="copyApiKey()" title="Copy to Clipboard"
                                    style="padding: 0.5rem; border-radius: 0.5rem; background: #3b82f6; color: white; border: none; cursor: pointer; transition: all 0.2s ease; display: flex; align-items: center; justify-content: center;"
                                    onmouseover="this.style.background='#2563eb'"
                                    onmouseout="this.style.background='#3b82f6'">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div
                            style="margin-top: 1rem; display: flex; align-items: center; gap: 0.5rem; color: #dc2626; font-size: 0.875rem;">
                            <svg style="width: 1rem; height: 1rem; flex-shrink: 0;" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            Keep this key secure! It won't be shown again.
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div
                        style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem;">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                            <div
                                style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div style="min-width: 0; flex: 1;">
                                <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">Quick Actions
                                </h3>
                                <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">Manage your API key</p>
                            </div>
                        </div>

                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <form action="{{ route('api-keys.regenerate', $apiKey) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    style="width: 100%; display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 1px solid #f59e0b; border-radius: 0.75rem; background: #fef3c7; color: #92400e; font-weight: 600; cursor: pointer; transition: all 0.2s ease; white-space: nowrap; justify-content: center; text-align: center;"
                                    onmouseover="this.style.background='#fde68a'; this.style.transform='translateY(-1px)';"
                                    onmouseout="this.style.background='#fef3c7'; this.style.transform='translateY(0)';"
                                    onclick="return confirm('This will generate a new API key. The old key will stop working immediately. Continue?')">
                                    <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    <span>Regenerate Key</span>
                                </button>
                            </form>

                            <form action="{{ route('api-keys.toggle', $apiKey) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    style="width: 100%; display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 1px solid {{ $apiKey->is_active ? '#6b7280' : '#10b981' }}; border-radius: 0.75rem; background: {{ $apiKey->is_active ? '#f3f4f6' : '#dcfce7' }}; color: {{ $apiKey->is_active ? '#374151' : '#166534' }}; font-weight: 600; cursor: pointer; transition: all 0.2s ease; white-space: nowrap; justify-content: center; text-align: center;"
                                    onmouseover="this.style.background='{{ $apiKey->is_active ? '#e5e7eb' : '#bbf7d0' }}'; this.style.transform='translateY(-1px)';"
                                    onmouseout="this.style.background='{{ $apiKey->is_active ? '#f3f4f6' : '#dcfce7' }}'; this.style.transform='translateY(0)';">
                                    @if ($apiKey->is_active)
                                        <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span>Deactivate Key</span>
                                    @else
                                        <svg style="width: 1.25rem; height: 1.25rem; flex-shrink: 0;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h1m4 0h1m-6 4h6m2 5H7a2 2 0 01-2-2V9a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <span>Activate Key</span>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- API Key Details -->
            <div
                style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem; margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                    <div
                        style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div style="min-width: 0; flex: 1;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">API Key Details</h3>
                        <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">Configuration and usage information</p>
                    </div>
                </div>

                <div class="details-grid" style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                    <!-- Left Column -->
                    <div>
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <div>
                                <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Name</div>
                                <div style="color: #1f2937; font-size: 1.125rem; word-break: break-word;">
                                    {{ $apiKey->name }}</div>
                            </div>

                            <div>
                                <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status</div>
                                <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                    @if ($apiKey->isActive())
                                        <span
                                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #dcfce7; color: #166534; white-space: nowrap;">Active</span>
                                    @else
                                        <span
                                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fee2e2; color: #991b1b; white-space: nowrap;">Inactive</span>
                                    @endif
                                    @if ($apiKey->isExpired())
                                        <span
                                            style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 600; border-radius: 9999px; background: #fef3c7; color: #92400e; white-space: nowrap;">Expired</span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Created</div>
                                <div style="color: #1f2937; word-break: break-word;">
                                    {{ $apiKey->created_at->format('M d, Y H:i:s') }}</div>
                                <div style="color: #6b7280; font-size: 0.875rem;">
                                    {{ $apiKey->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                            <div>
                                <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Last Used</div>
                                @if ($apiKey->last_used_at)
                                    <div style="color: #1f2937; word-break: break-word;">
                                        {{ $apiKey->last_used_at->format('M d, Y H:i:s') }}</div>
                                    <div style="color: #6b7280; font-size: 0.875rem;">
                                        {{ $apiKey->last_used_at->diffForHumans() }}</div>
                                @else
                                    <div style="color: #6b7280;">Never used</div>
                                @endif
                            </div>

                            <div>
                                <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Expires</div>
                                @if ($apiKey->expires_at)
                                    <div style="color: #1f2937; word-break: break-word;">
                                        {{ $apiKey->expires_at->format('M d, Y H:i:s') }}</div>
                                    <div style="color: #6b7280; font-size: 0.875rem;">
                                        {{ $apiKey->expires_at->diffForHumans() }}</div>
                                @else
                                    <div style="color: #6b7280;">Never expires</div>
                                @endif
                            </div>

                            <div>
                                <div style="font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Permissions</div>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                    @if ($apiKey->permissions)
                                        @foreach ($apiKey->permissions as $permission)
                                            <span
                                                style="padding: 0.25rem 0.75rem; font-size: 0.75rem; font-weight: 500; border-radius: 9999px; background: #dbeafe; color: #1e40af; white-space: nowrap;">{{ $permission }}</span>
                                        @endforeach
                                    @else
                                        <span style="color: #6b7280;">All permissions</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Examples -->
            <div
                style="background: white; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                    <div
                        style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #6366f1, #4f46e5); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div style="min-width: 0; flex: 1;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin: 0;">Usage Examples</h3>
                        <p style="color: #6b7280; margin: 0; font-size: 0.875rem;">Code examples for API integration</p>
                    </div>
                </div>

                <div style="display: grid; gap: 1.5rem;">
                    <!-- cURL Example -->
                    <div>
                        <h4
                            style="font-weight: 600; color: #374151; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span
                                style="padding: 0.25rem 0.5rem; background: #e0e7ff; color: #3730a3; border-radius: 0.25rem; font-size: 0.75rem; white-space: nowrap;">cURL</span>
                            <span>Create Order</span>
                        </h4>
                        <div class="code-container"
                            style="background: #1f2937; border-radius: 0.5rem; padding: 0.75rem; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <pre class="code-block"
                                style="color: #f9fafb; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 0.625rem; margin: 0; white-space: pre; overflow-x: auto; line-height: 1.3;"><code>curl -X POST {{ url('/api/v1/orders') }} \
  -H "X-API-Key: {{ $apiKey->key }}" \
  -H "Content-Type: application/json" \
  -d '{"customer_name":"John Doe","total_amount":3000}'</code></pre>
                        </div>
                    </div>

                    <!-- JavaScript Example -->
                    <div>
                        <h4
                            style="font-weight: 600; color: #374151; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span
                                style="padding: 0.25rem 0.5rem; background: #fef3c7; color: #92400e; border-radius: 0.25rem; font-size: 0.75rem; white-space: nowrap;">JavaScript</span>
                            <span>Track Order</span>
                        </h4>
                        <div class="code-container"
                            style="background: #1f2937; border-radius: 0.5rem; padding: 0.75rem; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <pre class="code-block"
                                style="color: #f9fafb; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 0.625rem; margin: 0; white-space: pre; overflow-x: auto; line-height: 1.3;"><code>fetch('{{ url('/api/v1/orders/TRACK123/track') }}', {
  headers: { 'X-API-Key': '{{ $apiKey->key }}' }
})
.then(res => res.json())
.then(data => console.log(data));</code></pre>
                        </div>
                    </div>

                    <!-- Node.js Example -->
                    <div>
                        <h4
                            style="font-weight: 600; color: #374151; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span
                                style="padding: 0.25rem 0.5rem; background: #dcfce7; color: #166534; border-radius: 0.25rem; font-size: 0.75rem; white-space: nowrap;">Node.js</span>
                            <span>With Axios</span>
                        </h4>
                        <div class="code-container"
                            style="background: #1f2937; border-radius: 0.5rem; padding: 0.75rem; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <pre class="code-block"
                                style="color: #f9fafb; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 0.625rem; margin: 0; white-space: pre; overflow-x: auto; line-height: 1.3;"><code>const axios = require('axios');

axios.post('{{ url('/api/v1/orders') }}', {
  customer_name: 'John Doe',
  total_amount: 3000
}, {
  headers: { 'X-API-Key': '{{ $apiKey->key }}' }
})
.then(res => console.log(res.data));</code></pre>
                        </div>
                    </div>

                    <!-- PHP Example -->
                    <div>
                        <h4
                            style="font-weight: 600; color: #374151; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
                            <span
                                style="padding: 0.25rem 0.5rem; background: #ddd6fe; color: #5b21b6; border-radius: 0.25rem; font-size: 0.75rem; white-space: nowrap;">PHP</span>
                            <span>Basic Request</span>
                        </h4>
                        <div class="code-container"
                            style="background: #1f2937; border-radius: 0.5rem; padding: 0.75rem; overflow-x: auto; -webkit-overflow-scrolling: touch;">
                            <pre class="code-block"
                                style="color: #f9fafb; font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace; font-size: 0.625rem; margin: 0; white-space: pre; overflow-x: auto; line-height: 1.3;"><code>$ch = curl_init('{{ url('/api/v1/orders') }}');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'X-API-Key: {{ $apiKey->key }}',
  'Content-Type: application/json'
]);
$response = curl_exec($ch);</code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleApiKeyVisibility() {
            const input = document.getElementById('apiKeyValue');
            const icon = document.getElementById('toggleIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
            } else {
                input.type = 'password';
                icon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
            }
        }

        function copyApiKey() {
            const input = document.getElementById('apiKeyValue');
            input.select();
            input.setSelectionRange(0, 99999);

            // Use modern clipboard API if available
            if (navigator.clipboard) {
                navigator.clipboard.writeText(input.value).then(() => {
                    showCopyFeedback();
                });
            } else {
                // Fallback for older browsers
                document.execCommand('copy');
                showCopyFeedback();
            }
        }

        function showCopyFeedback() {
            const button = event.target.closest('button');
            const originalHTML = button.innerHTML;

            button.innerHTML = `
                <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            `;
            button.style.background = '#10b981';

            setTimeout(() => {
                button.innerHTML = originalHTML;
                button.style.background = '#3b82f6';
            }, 2000);
        }
    </script>

    <style>
        /* Mobile-first responsive design */

        /* Base mobile styles */
        @media (max-width: 640px) {

            /* Reduce overall padding on mobile */
            .page-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 1rem !important;
            }

            .page-title {
                font-size: 1.5rem !important;
            }

            /* API Key input adjustments for mobile */
            .api-key-actions {
                position: relative !important;
                top: auto !important;
                right: auto !important;
                transform: none !important;
                margin-top: 0.75rem !important;
                justify-content: center !important;
            }

            #apiKeyValue {
                padding-right: 1rem !important;
                margin-bottom: 0.75rem !important;
            }

            /* Code blocks mobile optimization - MUCH SMALLER */
            .code-container {
                padding: 0.5rem !important;
                margin: 0 !important;
                border-radius: 0.375rem !important;
                font-size: 0.5rem !important;
            }

            .code-block {
                font-size: 0.5rem !important;
                line-height: 1.2 !important;
                white-space: pre !important;
                word-wrap: normal !important;
                overflow-wrap: normal !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
            }

            /* Make code examples section more compact */
            .code-container pre {
                margin: 0 !important;
                padding: 0 !important;
            }

            /* Reduce spacing between code examples */
            .usage-examples>div {
                margin-bottom: 1rem !important;
            }

            /* Button text stacking on mobile */
            .quick-action-button {
                flex-direction: column !important;
                text-align: center !important;
                gap: 0.5rem !important;
            }

            /* Grid adjustments */
            .api-grid {
                grid-template-columns: 1fr !important;
            }

            .details-grid {
                grid-template-columns: 1fr !important;
            }
        }

        /* Extra small mobile screens */
        @media (max-width: 480px) {
            .code-block {
                font-size: 0.45rem !important;
                line-height: 1.1 !important;
            }

            .code-container {
                padding: 0.375rem !important;
                font-size: 0.45rem !important;
            }
        }

        /* Tablet styles */
        @media (min-width: 641px) and (max-width: 1024px) {
            .api-grid {
                grid-template-columns: 1fr !important;
            }

            .details-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .code-block {
                font-size: 0.625rem !important;
            }
        }

        /* Desktop styles */
        @media (min-width: 1025px) {
            .api-grid {
                grid-template-columns: 2fr 1fr !important;
            }

            .details-grid {
                grid-template-columns: repeat(2, 1fr) !important;
            }

            .code-block {
                font-size: 0.75rem !important;
            }
        }

        /* Ensure horizontal scrolling for code blocks on all devices */
        .code-container {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            max-width: 100%;
            width: 100%;
        }

        .code-block {
            min-width: max-content;
            white-space: pre;
            overflow-x: auto;
            width: auto;
            display: block;
        }

        /* Improve touch targets on mobile */
        @media (max-width: 640px) {
            button {
                min-height: 44px !important;
                padding: 0.75rem 1rem !important;
            }

            a {
                min-height: 44px !important;
                display: flex !important;
                align-items: center !important;
            }
        }

        /* Fix for API key input container on mobile */
        @media (max-width: 640px) {
            .api-key-container {
                position: relative;
            }

            .api-key-container input {
                width: 100%;
                padding-right: 1rem;
            }

            .api-key-actions {
                position: static !important;
                display: flex !important;
                justify-content: center !important;
                margin-top: 0.75rem !important;
                gap: 0.75rem !important;
            }
        }

        /* Responsive text sizing */
        @media (max-width: 640px) {
            h1 {
                font-size: 1.5rem !important;
            }

            h3 {
                font-size: 1.25rem !important;
            }

            h4 {
                font-size: 1rem !important;
            }
        }

        /* Ensure flex-shrink: 0 on icons to prevent squishing */
        svg {
            flex-shrink: 0;
        }

        /* Better spacing on mobile */
        @media (max-width: 640px) {
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
        }

        /* Force code to not break and stay scrollable */
        .code-container code {
            white-space: pre !important;
            word-break: normal !important;
            overflow-wrap: normal !important;
        }
    </style>
@endsection
