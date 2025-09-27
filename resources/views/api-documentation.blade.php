@extends('layouts.app')

@section('content')
    <div style="min-height: 100vh; background: #f8fafc; padding: 2rem 1rem;">
        <div style="max-width: 1280px; margin: 0 auto;">

            <!-- Header Section -->
            <div id="page-header" style="margin-bottom: 2rem; display: flex; gap: 1rem; flex-direction: column;">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="flex-shrink: 0; width: 3.5rem; height: 3.5rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 1rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 20px -5px rgba(59, 130, 246, 0.4);">
                        <svg style="width: 2rem; height: 2rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <div>
                        <h1 style="font-size: 2rem; font-weight: 700; color: #1f2937; margin: 0;">API Documentation</h1>
                        <p style="color: #6b7280; margin: 0;">Complete integration guide for our logistics and delivery API
                        </p>
                    </div>
                </div>
                <div style="flex-shrink: 0;">
                    <a href="{{ route('api-keys.index') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; text-decoration: none; color: white; padding: 0.75rem 1.5rem; border-radius: 0.75rem; font-weight: 600; background: linear-gradient(135deg, #ED1C24, #c41e3a); border: none; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(237, 28, 36, 0.3)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0,0,0,0.1)';">
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                        Manage API Keys
                    </a>
                </div>
            </div>

            <!-- Navigation Tabs -->
            <div
                style="background: white; border-radius: 1rem; padding: 1rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; overflow-x: auto; gap: 0.5rem; padding-bottom: 0.5rem;">
                    <a href="#overview"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Overview</a>
                    <a href="#authentication"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Authentication</a>
                    <a href="#endpoints"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Endpoints</a>
                    <a href="#cities-api"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Cities API</a>
                    <a href="#rate-calculation"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Rate
                        Calculation</a>
                    <a href="#examples"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Code
                        Examples</a>
                    <a href="#statuses"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Order
                        Statuses</a>
                    <a href="#errors"
                        style="flex-shrink: 0; text-decoration: none; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; transition: all 0.2s ease;">Error
                        Handling</a>
                </div>
            </div>

            <!-- Overview Section -->
            <div id="overview"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">API Overview</h2>
                </div>

                <p style="color: #4b5563; margin-bottom: 1.5rem;">Welcome to our Logistics API! This API allows you to
                    integrate delivery services into your application. You can create orders, track shipments, and manage
                    deliveries across Kenya, Tanzania, and Uganda.</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.25rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.75rem;">Base URL
                        </h3>
                        <div
                            style="background: #1f2937; color: white; padding: 0.75rem; border-radius: 0.5rem; font-family: monospace; overflow-x: auto;">
                            {{ url('/api/v1') }}</div>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.25rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.75rem;">Supported
                            Countries</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            <span
                                style="display: inline-flex; align-items: center; gap: 0.25rem; background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">
                                <svg style="width: 0.75rem; height: 0.75rem; color: #0ea5e9;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Kenya
                            </span>
                            <span
                                style="display: inline-flex; align-items: center; gap: 0.25rem; background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">
                                <svg style="width: 0.75rem; height: 0.75rem; color: #0ea5e9;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Tanzania
                            </span>
                            <span
                                style="display: inline-flex; align-items: center; gap: 0.25rem; background: #e0f2fe; color: #0369a1; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">
                                <svg style="width: 0.75rem; height: 0.75rem; color: #0ea5e9;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Uganda
                            </span>
                        </div>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.25rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.75rem;">Supported
                            Currencies</h3>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                            <span
                                style="background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">KES</span>
                            <span
                                style="background: #e0f2fe; color: #0c4a6e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">TZS</span>
                            <span
                                style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">UGX</span>
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem;">USD</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Authentication Section -->
            <div id="authentication"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Authentication</h2>
                </div>

                <p style="color: #4b5563; margin-bottom: 1.5rem;">Our API uses API keys for authentication. You need to
                    include your API key in every request.</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.25rem;">
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Getting Your
                            API Key</h3>
                        <ol
                            style="color: #4b5563; padding-left: 1.25rem; display: flex; flex-direction: column; gap: 0.5rem;">
                            <li>Register an account on our platform</li>
                            <li>Wait for admin approval for API access</li>
                            <li>Generate your API key from the <a href="{{ route('api-keys.index') }}"
                                    style="color: #3b82f6; text-decoration: none;">dashboard</a></li>
                            <li>Keep your API key secure</li>
                        </ol>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.25rem;">
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Authentication
                            Methods</h3>

                        <div style="margin-bottom: 1rem;">
                            <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.5rem;">
                                Method 1: X-API-Key Header</h4>
                            <div
                                style="background: #1f2937; color: white; padding: 0.75rem; border-radius: 0.5rem; font-family: monospace; overflow-x: auto; position: relative;">
                                <span>X-API-Key: sk_your_api_key_here</span>
                                <button onclick="copyToClipboard('X-API-Key: sk_your_api_key_here')"
                                    style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.25rem 0.5rem; cursor: pointer;">
                                    <svg style="width: 0.875rem; height: 0.875rem; color: white;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.5rem;">
                                Method 2: Bearer Token</h4>
                            <div
                                style="background: #1f2937; color: white; padding: 0.75rem; border-radius: 0.5rem; font-family: monospace; overflow-x: auto; position: relative;">
                                <span>Authorization: Bearer sk_your_api_key_here</span>
                                <button onclick="copyToClipboard('Authorization: Bearer sk_your_api_key_here')"
                                    style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.25rem 0.5rem; cursor: pointer;">
                                    <svg style="width: 0.875rem; height: 0.875rem; color: white;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Endpoints Section -->
            <div id="endpoints"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #38bdf8, #0ea5e9); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">API Endpoints</h2>
                </div>

                <!-- Get Orders Endpoint -->
                <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <span
                            style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                        <span style="font-family: monospace; font-weight: 500; color: #1f2937;">/orders</span>
                    </div>
                    <p style="color: #4b5563; margin-bottom: 1rem;">Retrieve all your orders with optional filtering.</p>

                    <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Query
                        Parameters</h4>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                            <thead>
                                <tr style="background: #f9fafb; text-align: left;">
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Parameter</th>
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Type</th>
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Required</th>
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        status</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Filter by
                                        order status</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        tracking_number</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Search by
                                        tracking number</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        external_order_id</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Search by your
                                        order ID</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Create Order Endpoint -->
                <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <span
                            style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">POST</span>
                        <span style="font-family: monospace; font-weight: 500; color: #1f2937;">/orders</span>
                    </div>
                    <p style="color: #4b5563; margin-bottom: 1rem;">Create a new delivery order.</p>

                    <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Request Body
                    </h4>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                            <thead>
                                <tr style="background: #f9fafb; text-align: left;">
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Field</th>
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Type</th>
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Required</th>
                                    <th
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                        Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        customer_name</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Customer full
                                        name</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        customer_email</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Customer email
                                        address</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        customer_phone</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Customer phone
                                        number</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        origin_address</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Complete pickup address</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        origin_city</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Pickup city name</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        origin_country</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Pickup country (Kenya, Tanzania, Uganda)</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        origin_state</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Pickup state/region</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        origin_postal_code</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Pickup postal code</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        delivery_address</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Full delivery
                                        address</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        city</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Delivery city
                                    </td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        country</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Kenya,
                                        Tanzania, or Uganda</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        items</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">array</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Array of order
                                        items</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        total_amount</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">number</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #ef4444;">Required</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Total order
                                        amount</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        external_order_id</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Your internal
                                        order ID</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        currency</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Currency code
                                        (default: KES)</td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        cash_on_delivery</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">boolean</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Enable cash on
                                        delivery</td>
                                </tr>
                                <tr style="background: #f9fafb;">
                                    <td
                                        style="padding: 0.75rem; border: 1px solid #e5e7eb; font-family: monospace; color: #1f2937;">
                                        delivery_type</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">string</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #10b981;">Optional</td>
                                    <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">standard,
                                        express, same_day</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Other Endpoints -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span
                                style="font-family: monospace; font-weight: 500; color: #1f2937;">/orders/{tracking_number}</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Get details of a specific order.</p>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span
                                style="font-family: monospace; font-weight: 500; color: #1f2937;">/orders/{tracking_number}/track</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Get tracking information for an order.</p>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dbeafe; color: #1e40af; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">PUT</span>
                            <span
                                style="font-family: monospace; font-weight: 500; color: #1f2937;">/orders/{tracking_number}</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Update order details (limited fields).</p>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">DELETE</span>
                            <span
                                style="font-family: monospace; font-weight: 500; color: #1f2937;">/orders/{tracking_number}/cancel</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Cancel an order (if not yet delivered).</p>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">POST</span>
                            <span
                                style="font-family: monospace; font-weight: 500; color: #1f2937;">/calculate-rate</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Calculate shipping rates for checkout integration.</p>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span style="font-family: monospace; font-weight: 500; color: #1f2937;">/statuses</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Get list of all available order statuses.</p>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #e0f2fe; color: #0c4a6e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span
                                style="font-family: monospace; font-weight: 500; color: #1f2937;">/track/{tracking_number}</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem;">Public tracking (no authentication required).</p>
                    </div>
                </div>
            </div>

            <!-- Cities API Section -->
            <div id="cities-api"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Cities API</h2>
                </div>

                <p style="color: #4b5563; margin-bottom: 1.5rem;">
                    The Cities API provides comprehensive access to cities and locations across Kenya, Tanzania, and Uganda.
                    Perfect for populating dropdown menus, address autocomplete, and shipping form validation.
                </p>

                <div style="background: #dcfce7; border: 1px solid #16a34a; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <svg style="width: 1.25rem; height: 1.25rem; color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <strong style="color: #16a34a; font-weight: 600;">Public Endpoints Available</strong>
                    </div>
                    <p style="font-size: 0.875rem; color: #166534; margin: 0;">
                        Cities endpoints are also available at <code>/api/public/cities/*</code> without authentication for easier frontend integration.
                    </p>
                </div>

                <!-- Get All Cities -->
                <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                        <span
                            style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                        <span style="font-family: monospace; font-weight: 500; color: #1f2937;">/cities</span>
                    </div>
                    <p style="color: #4b5563; margin-bottom: 1rem;">Get all cities with optional filtering by country, type, and search.</p>

                    <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Query Parameters</h4>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                            <thead>
                                <tr style="background: #f9fafb; text-align: left;">
                                    <th style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Parameter</th>
                                    <th style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Type</th>
                                    <th style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Description</th>
                                    <th style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-weight: 600;">Example</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-family: monospace; color: #dc2626;">country</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">string</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Filter by country (KEN, TZS, UGA)</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-family: monospace; color: #4b5563;">?country=KEN</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-family: monospace; color: #dc2626;">major_only</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">boolean</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Show only major cities</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-family: monospace; color: #4b5563;">?major_only=true</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-family: monospace; color: #dc2626;">nairobi_areas</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">boolean</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb;">Show only Nairobi areas</td>
                                    <td style="padding: 0.75rem; border-bottom: 1px solid #e5e7eb; font-family: monospace; color: #4b5563;">?nairobi_areas=true</td>
                                </tr>
                                <tr>
                                    <td style="padding: 0.75rem; font-family: monospace; color: #dc2626;">search</td>
                                    <td style="padding: 0.75rem;">string</td>
                                    <td style="padding: 0.75rem;">Search by city name</td>
                                    <td style="padding: 0.75rem; font-family: monospace; color: #4b5563;">?search=nairobi</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Access Endpoints -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span style="font-family: monospace; font-weight: 500; color: #1f2937; font-size: 0.875rem;">/cities/major</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 0.5rem;">Get major cities optimized for dropdowns</p>
                        <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.75rem;">
                            <strong>Perfect for:</strong> Origin/destination dropdowns
                        </div>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span style="font-family: monospace; font-weight: 500; color: #1f2937; font-size: 0.875rem;">/cities/search</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 0.5rem;">Real-time search with autocomplete</p>
                        <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.75rem;">
                            <strong>Perfect for:</strong> Search-as-you-type features
                        </div>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span style="font-family: monospace; font-weight: 500; color: #1f2937; font-size: 0.875rem;">/cities/nairobi-areas</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 0.5rem;">All Nairobi metropolitan areas</p>
                        <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.75rem;">
                            <strong>Perfect for:</strong> Detailed delivery zones
                        </div>
                    </div>

                    <div style="border: 1px solid #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <span
                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">GET</span>
                            <span style="font-family: monospace; font-weight: 500; color: #1f2937; font-size: 0.875rem;">/cities/countries</span>
                        </div>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 0.5rem;">Get supported countries</p>
                        <div style="background: #f9fafb; padding: 0.5rem; border-radius: 0.375rem; font-size: 0.75rem;">
                            <strong>Returns:</strong> KEN, TZS, UGA with counts
                        </div>
                    </div>
                </div>

                <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Example Response</h3>
                <div style="background: #1f2937; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem;">
                    <pre style="color: #f3f4f6; font-family: monospace; font-size: 0.875rem; margin: 0; overflow-x: auto; white-space: pre-wrap;">{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Nairobi",
      "normalized_name": "nairobi",
      "region": "Nairobi County",
      "country": "KEN",
      "country_name": "Kenya",
      "latitude": "-1.29210000",
      "longitude": "36.82190000",
      "is_major_city": true,
      "is_nairobi_area": true,
      "aliases": ["nairobi city", "nairobi cbd", "cbd"]
    },
    {
      "id": 2,
      "name": "Mombasa",
      "normalized_name": "mombasa",
      "region": "Mombasa County",
      "country": "KEN",
      "country_name": "Kenya",
      "latitude": "-4.04350000",
      "longitude": "39.66820000",
      "is_major_city": true,
      "is_nairobi_area": false,
      "aliases": ["mombasa city"]
    }
  ],
  "meta": {
    "total": 2,
    "filters_applied": {"country": "KEN", "major_only": true}
  },
  "message": "Cities retrieved successfully"
}</pre>
                </div>

                <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Integration Examples</h3>

                <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1rem;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Populate Dropdown Menu</h4>
                    <pre style="color: #374151; font-family: monospace; font-size: 0.75rem; margin: 0; overflow-x: auto;">fetch('/api/public/cities/major?country=KEN')
  .then(response => response.json())
  .then(data => {
    const select = document.getElementById('city-select');
    data.data.forEach(city => {
      const option = document.createElement('option');
      option.value = city.normalized_name;
      option.textContent = city.name;
      select.appendChild(option);
    });
  });</pre>
                </div>

                <div style="background: #f8fafc; border-radius: 0.75rem; padding: 1rem;">
                    <h4 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">Search Autocomplete</h4>
                    <pre style="color: #374151; font-family: monospace; font-size: 0.75rem; margin: 0; overflow-x: auto;">function searchCities(query) {
  if (query.length < 2) return;

  fetch(`/api/public/cities/search?q=${encodeURIComponent(query)}&limit=5`)
    .then(response => response.json())
    .then(data => {
      displaySearchResults(data.data);
    });
}</pre>
                </div>
            </div>

            <!-- Code Examples Section -->
            <div id="examples"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Code Examples</h2>
                </div>

                <!-- Tab Navigation -->
                <div style="display: flex; overflow-x: auto; gap: 0.5rem; padding-bottom: 0.5rem; margin-bottom: 1rem;">
                    <button onclick="showTab('php')" id="php-tab"
                        style="flex-shrink: 0; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: white; background: #3b82f6; border: none; cursor: pointer; transition: all 0.2s ease;">PHP</button>
                    <button onclick="showTab('nodejs')" id="nodejs-tab"
                        style="flex-shrink: 0; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; border: none; cursor: pointer; transition: all 0.2s ease;">Node.js</button>
                    <button onclick="showTab('curl')" id="curl-tab"
                        style="flex-shrink: 0; padding: 0.5rem 1rem; border-radius: 0.5rem; font-weight: 500; color: #4b5563; background: #f3f4f6; border: none; cursor: pointer; transition: all 0.2s ease;">cURL</button>
                </div>

                <!-- Tab Content -->
                <div id="php-tab-content" style="display: block;">
                    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">PHP Example -
                        Create Order</h3>
                    <div style="position: relative;">
                        <pre
                            style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem; margin-bottom: 1.5rem;"><code>&lt;?php

$apiKey = 'sk_your_api_key_here';
$baseUrl = '{{ url('/api/v1') }}';

// Order data
$orderData = [
    'external_order_id' => 'ORD-12345',
    'customer_name' => 'John Doe',
    'customer_email' => 'john@example.com',
    'customer_phone' => '+254712345678',
    'origin_address' => '456 Industrial Area, Nairobi',
    'origin_city' => 'Nairobi',
    'origin_country' => 'Kenya',
    'delivery_address' => '123 Main Street, Westlands',
    'city' => 'Nairobi',
    'country' => 'Kenya',
    'items' => [
        [
            'name' => 'Product 1',
            'quantity' => 2,
            'price' => 1500,
            'description' => 'Sample product'
        ]
    ],
    'total_amount' => 3000,
    'currency' => 'KES',
    'cash_on_delivery' => true,
    'cod_amount' => 3000,
    'delivery_type' => 'standard'
];

// Initialize cURL
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => $baseUrl . '/orders',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($orderData),
    CURLOPT_HTTPHEADER => [
        'X-API-Key: ' . $apiKey,
        'Content-Type: application/json'
    ],
]);

$response = curl_exec($curl);
$result = json_decode($response, true);
curl_close($curl);

if ($result['success']) {
    echo "Order created: " . $result['data']['tracking_number'];
} else {
    echo "Error: " . $result['message'];
}
?&gt;</code></pre>
                        <button
                            onclick="copyToClipboard(document.getElementById('php-tab-content').querySelector('code').textContent)"
                            style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                            <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="nodejs-tab-content" style="display: none;">
                    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Node.js Example -
                        Create Order</h3>
                    <div style="position: relative;">
                        <pre
                            style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem; margin-bottom: 1.5rem;"><code>const axios = require('axios');

const apiKey = 'sk_your_api_key_here';
const baseURL = '{{ url('/api/v1') }}';

const client = axios.create({
    baseURL: baseURL,
    headers: {
        'X-API-Key': apiKey,
        'Content-Type': 'application/json'
    }
});

// Create Order
const orderData = {
    external_order_id: 'ORD-12345',
    customer_name: 'John Doe',
    customer_email: 'john@example.com',
    customer_phone: '+254712345678',
    origin_address: '456 Industrial Area, Nairobi',
    origin_city: 'Nairobi',
    origin_country: 'Kenya',
    delivery_address: '123 Main Street, Westlands',
    city: 'Nairobi',
    country: 'Kenya',
    items: [
        {
            name: 'Product 1',
            quantity: 2,
            price: 1500,
            description: 'Sample product'
        }
    ],
    total_amount: 3000,
    currency: 'KES',
    cash_on_delivery: true,
    cod_amount: 3000,
    delivery_type: 'standard'
};

// Create order
client.post('/orders', orderData)
    .then(response => {
        console.log('Order created:', response.data.data.tracking_number);
    })
    .catch(error => {
        console.error('Error:', error.response?.data?.message || error.message);
    });</code></pre>
                        <button
                            onclick="copyToClipboard(document.getElementById('nodejs-tab-content').querySelector('code').textContent)"
                            style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                            <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="curl-tab-content" style="display: none;">
                    <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">cURL Examples</h3>

                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Create
                            Order</h4>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>curl -X POST {{ url('/api/v1/orders') }} \
  -H "X-API-Key: sk_your_api_key_here" \
  -H "Content-Type: application/json" \
  -d '{
    "external_order_id": "ORD-12345",
    "customer_name": "John Doe",
    "customer_email": "john@example.com",
    "customer_phone": "+254712345678",
    "origin_address": "456 Industrial Area, Nairobi",
    "origin_city": "Nairobi",
    "origin_country": "Kenya",
    "delivery_address": "123 Main Street, Westlands",
    "city": "Nairobi",
    "country": "Kenya",
    "items": [
      {
        "name": "Product 1",
        "quantity": 2,
        "price": 1500,
        "description": "Sample product"
      }
    ],
    "total_amount": 3000,
    "currency": "KES",
    "cash_on_delivery": true,
    "cod_amount": 3000,
    "delivery_type": "standard"
  }'</code></pre>
                            <button
                                onclick="copyToClipboard(document.getElementById('curl-tab-content').querySelectorAll('code')[0].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Track
                            Order</h4>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>curl -X GET {{ url('/api/v1/orders') }}/TRACKING_NUMBER/track \
  -H "X-API-Key: sk_your_api_key_here"</code></pre>
                            <button
                                onclick="copyToClipboard(document.getElementById('curl-tab-content').querySelectorAll('code')[1].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Get All
                            Orders</h4>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>curl -X GET {{ url('/api/v1/orders') }} \
  -H "X-API-Key: sk_your_api_key_here"</code></pre>
                            <button
                                onclick="copyToClipboard(document.getElementById('curl-tab-content').querySelectorAll('code')[2].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Calculate
                            Shipping Rate</h4>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>curl -X POST {{ url('/api/v1/calculate-rate') }} \
  -H "X-API-Key: sk_your_api_key_here" \
  -H "Content-Type: application/json" \
  -d '{
    "weight": 4.0,
    "origin_city": "Nairobi",
    "destination_city": "Meru",
    "delivery_type": "standard"
  }'</code></pre>
                            <button
                                onclick="copyToClipboard(document.getElementById('curl-tab-content').querySelectorAll('code')[3].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #4b5563; margin-bottom: 0.75rem;">Public
                            Tracking (No Authentication)</h4>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>curl -X GET {{ url('/api/v1/track') }}/TRACKING_NUMBER</code></pre>
                            <button
                                onclick="copyToClipboard(document.getElementById('curl-tab-content').querySelectorAll('code')[4].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rate Calculation Section -->
            <div id="rate-calculation"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Rate Calculation</h2>
                </div>

                <p style="color: #4b5563; margin-bottom: 1.5rem;">
                    Calculate shipping rates for checkout integration. This endpoint allows you to get accurate pricing 
                    before creating orders, perfect for e-commerce platforms and checkout flows.
                </p>

                <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.25rem; margin-bottom: 1.5rem;">
                    <h3 style="font-size: 0.875rem; font-weight: 600; color: #6b7280; margin-bottom: 0.75rem;">
                        Pricing Rules
                    </h3>
                    <div style="display: grid; gap: 1rem;">
                        <div style="display: flex; align-items: start; gap: 0.75rem;">
                            <div style="flex-shrink: 0; width: 1.25rem; height: 1.25rem; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-top: 0.125rem;">
                                <svg style="width: 0.75rem; height: 0.75rem; color: #16a34a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin: 0 0 0.25rem 0;">Within Nairobi</h4>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">Flat rate of <strong>415 KSH</strong> per package, regardless of weight or distance</p>
                            </div>
                        </div>
                        <div style="display: flex; align-items: start; gap: 0.75rem;">
                            <div style="flex-shrink: 0; width: 1.25rem; height: 1.25rem; background: #dbeafe; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-top: 0.125rem;">
                                <svg style="width: 0.75rem; height: 0.75rem; color: #2563eb;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin: 0 0 0.25rem 0;">Nationwide (Outside Nairobi)</h4>
                                <p style="font-size: 0.875rem; color: #6b7280; margin: 0;">
                                    <strong>Base 100 KSH</strong> + <strong>10 KSH per kg</strong> + <strong>3 KSH per km</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="background: #fef3c7; border: 1px solid #f59e0b; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                        <svg style="width: 1rem; height: 1rem; color: #d97706;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h4 style="font-size: 0.875rem; font-weight: 600; color: #92400e; margin: 0;">Example Calculation</h4>
                    </div>
                    <p style="font-size: 0.875rem; color: #92400e; margin: 0;">
                        4 kg package from Nairobi to Meru (230 km) = 100 + (10 × 4) + (3 × 230) = <strong>830 KSH</strong>
                    </p>
                </div>

                <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Request Parameters</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                        <thead>
                            <tr style="background: #f9fafb;">
                                <th style="text-align: left; padding: 0.75rem; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Parameter</th>
                                <th style="text-align: left; padding: 0.75rem; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Type</th>
                                <th style="text-align: left; padding: 0.75rem; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Required</th>
                                <th style="text-align: left; padding: 0.75rem; font-weight: 600; color: #374151; border-bottom: 1px solid #e5e7eb;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6;"><code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: monospace;">weight</code></td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6; color: #6b7280;">number</td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6;"><span style="background: #dcfce7; color: #16a34a; padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Required</span></td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6; color: #6b7280;">Package weight in kilograms (0.1 - 1000)</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6;"><code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: monospace;">origin_city</code></td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6; color: #6b7280;">string</td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6;"><span style="background: #dcfce7; color: #16a34a; padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Required</span></td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6; color: #6b7280;">Origin city name (e.g., "Nairobi", "CBD", "Westlands")</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6;"><code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: monospace;">destination_city</code></td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6; color: #6b7280;">string</td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6;"><span style="background: #dcfce7; color: #16a34a; padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Required</span></td>
                                <td style="padding: 0.75rem; border-bottom: 1px solid #f3f4f6; color: #6b7280;">Destination city name</td>
                            </tr>
                            <tr>
                                <td style="padding: 0.75rem;"><code style="background: #f3f4f6; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-family: monospace;">delivery_type</code></td>
                                <td style="padding: 0.75rem; color: #6b7280;">string</td>
                                <td style="padding: 0.75rem;"><span style="background: #fef3c7; color: #92400e; padding: 0.125rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500;">Optional</span></td>
                                <td style="padding: 0.75rem; color: #6b7280;">Delivery speed: "standard" (1x), "express" (1.5x), "same_day" (2x)</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin: 1.5rem 0 1rem 0;">Example Response</h3>
                <div style="position: relative;">
                    <pre style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>{
  "success": true,
  "data": {
    "weight": 4,
    "origin_city": "Nairobi",
    "destination_city": "Meru",
    "distance_km": 230,
    "is_within_nairobi": false,
    "delivery_type": "standard",
    "calculation_breakdown": {
      "base_rate": 100,
      "weight_charge": 40,
      "distance_charge": 690,
      "total": 830
    },
    "delivery_type_multiplier": 1,
    "total_rate": 830,
    "currency": "KES"
  },
  "message": "Shipping rate calculated successfully"
}</code></pre>
                    <button
                        onclick="copyToClipboard(this.previousElementSibling.querySelector('code').textContent)"
                        style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Order Statuses Section -->
            <div id="statuses"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Order Statuses</h2>
                </div>

                <p style="color: #4b5563; margin-bottom: 1.5rem;">Orders go through various statuses during the delivery
                    process:</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>pending</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Order received but not processed</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>order_received</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Order confirmed in our system</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>processing</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Order being prepared for dispatch</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>dispatched</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Order dispatched from warehouse</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>picked_up</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Package picked up by delivery agent</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>in_transit</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Package on its way to destination</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>customs_clearance</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Package being cleared by customs</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>released_by_customs</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Package cleared customs</p>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>out_for_delivery</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Package out for final delivery</p>
                    </div>

                    <div style="background: #dcfce7; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #166534; margin-bottom: 0.5rem;">
                            <code>delivered</code>
                        </h3>
                        <p style="color: #166534; font-size: 0.875rem; margin: 0;">Package successfully delivered</p>
                    </div>

                    <div style="background: #fef3c7; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #92400e; margin-bottom: 0.5rem;">
                            <code>failed_delivery</code>
                        </h3>
                        <p style="color: #92400e; font-size: 0.875rem; margin: 0;">Delivery attempt failed</p>
                    </div>

                    <div style="background: #fef3c7; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #92400e; margin-bottom: 0.5rem;">
                            <code>wrong_address</code>
                        </h3>
                        <p style="color: #92400e; font-size: 0.875rem; margin: 0;">Incorrect delivery address</p>
                    </div>

                    <div style="background: #fef3c7; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #92400e; margin-bottom: 0.5rem;">
                            <code>contact_not_available</code>
                        </h3>
                        <p style="color: #92400e; font-size: 0.875rem; margin: 0;">Unable to reach recipient</p>
                    </div>

                    <div style="background: #fef3c7; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #92400e; margin-bottom: 0.5rem;">
                            <code>delayed_delivery</code>
                        </h3>
                        <p style="color: #92400e; font-size: 0.875rem; margin: 0;">Delivery delayed</p>
                    </div>

                    <div style="background: #fee2e2; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #991b1b; margin-bottom: 0.5rem;">
                            <code>item_damaged</code>
                        </h3>
                        <p style="color: #991b1b; font-size: 0.875rem; margin: 0;">Package damaged during transit</p>
                    </div>

                    <div style="background: #e5e7eb; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">
                            <code>returned_to_sender</code>
                        </h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin: 0;">Package returned to sender</p>
                    </div>

                    <div style="background: #1f2937; border-radius: 0.75rem; padding: 1rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 600; color: white; margin-bottom: 0.5rem;">
                            <code>cancelled</code>
                        </h3>
                        <p style="color: #e5e7eb; font-size: 0.875rem; margin: 0;">Order was cancelled</p>
                    </div>
                </div>
            </div>

            <!-- Error Handling Section -->
            <div id="errors"
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #ef4444, #dc2626); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Error Handling</h2>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">HTTP Status
                            Codes</h3>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
                                <thead>
                                    <tr style="background: #f9fafb; text-align: left;">
                                        <th
                                            style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                            Code</th>
                                        <th
                                            style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #6b7280; font-weight: 600;">
                                            Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">200</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">OK -
                                            Request successful</td>
                                    </tr>
                                    <tr style="background: #f9fafb;">
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #dcfce7; color: #166534; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">201</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Created -
                                            Resource created</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">400</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Bad
                                            Request - Invalid parameters</td>
                                    </tr>
                                    <tr style="background: #f9fafb;">
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">401</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">
                                            Unauthorized - Invalid API key</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">403</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Forbidden
                                            - Insufficient permissions</td>
                                    </tr>
                                    <tr style="background: #f9fafb;">
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">404</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Not Found
                                            - Resource not found</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">422</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Validation
                                            Error</td>
                                    </tr>
                                    <tr style="background: #f9fafb;">
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb;"><span
                                                style="background: #fee2e2; color: #991b1b; padding: 0.25rem 0.5rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">500</span>
                                        </td>
                                        <td style="padding: 0.75rem; border: 1px solid #e5e7eb; color: #4b5563;">Internal
                                            Server Error</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Error Response
                            Format</h3>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem; margin-bottom: 1.5rem;"><code>{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "customer_email": [
      "The customer email field is required."
    ],
    "items": [
      "The items field is required."
    ]
  }
}</code></pre>
                            <button onclick="copyToClipboard(document.querySelectorAll('#errors pre code')[0].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>

                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Success
                            Response Format</h3>
                        <div style="position: relative;">
                            <pre
                                style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>{
  "success": true,
  "data": {
    "id": 123,
    "tracking_number": "LG12345678",
    "status": "order_received",
    "customer_name": "John Doe",
    "created_at": "2025-07-15T10:30:00Z"
  },
  "message": "Order created successfully"
}</code></pre>
                            <button onclick="copyToClipboard(document.querySelectorAll('#errors pre code')[1].textContent)"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                                <svg style="width: 1rem; height: 1rem; color: white;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Response Examples Section -->
            <div
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #38bdf8, #0ea5e9); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Response Examples</h2>
                </div>

                <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Order Creation Response
                </h3>
                <div style="position: relative;">
                    <pre
                        style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem; margin-bottom: 1.5rem;"><code>{
  "success": true,
  "data": {
    "id": 123,
    "tracking_number": "LG12345678",
    "external_order_id": "ORD-12345",
    "customer_name": "John Doe",
    "customer_email": "john@example.com",
    "customer_phone": "+254712345678",
    "delivery_address": "123 Main Street, Westlands",
    "city": "Nairobi",
    "country": "Kenya",
    "status": "order_received",
    "status_label": "Order Received",
    "total_amount": "3000.00",
    "currency": "KES",
    "cash_on_delivery": true,
    "cod_amount": "3000.00",
    "delivery_type": "standard",
    "created_at": "2025-07-15T10:30:00.000000Z",
    "status_history": [
      {
        "status": "order_received",
        "status_label": "Order Received",
        "notes": "Order received from Your Company",
        "location": null,
        "created_at": "2025-07-15T10:30:00.000000Z"
      }
    ]
  },
  "message": "Order created successfully"
}</code></pre>
                    <button
                        onclick="copyToClipboard(document.querySelectorAll('#response-examples pre code')[0].textContent)"
                        style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </button>
                </div>

                <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Order Tracking Response
                </h3>
                <div style="position: relative;">
                    <pre
                        style="background: #1f2937; color: #e5e7eb; padding: 1.25rem; border-radius: 0.5rem; overflow-x: auto; font-family: monospace; font-size: 0.875rem;"><code>{
  "success": true,
  "data": {
    "tracking_number": "LG12345678",
    "status": "in_transit",
    "status_label": "In Transit",
    "estimated_delivery": "2025-07-17T18:00:00.000000Z",
    "actual_delivery": null,
    "history": [
      {
        "status": "order_received",
        "status_label": "Order Received",
        "notes": "Order received from Your Company",
        "location": null,
        "timestamp": "2025-07-15T10:30:00.000000Z"
      },
      {
        "status": "processing",
        "status_label": "Processing",
        "notes": "Order is being prepared for dispatch",
        "location": "Nairobi Warehouse",
        "timestamp": "2025-07-15T14:20:00.000000Z"
      },
      {
        "status": "in_transit",
        "status_label": "In Transit",
        "notes": "Package is on its way to destination",
        "location": "Nairobi Sorting Center",
        "timestamp": "2025-07-15T18:30:00.000000Z"
      }
    ]
  },
  "message": "Order tracking retrieved successfully"
}</code></pre>
                    <button
                        onclick="copyToClipboard(document.querySelectorAll('#response-examples pre code')[1].textContent)"
                        style="position: absolute; top: 0.5rem; right: 0.5rem; background: rgba(255,255,255,0.1); border: none; border-radius: 0.25rem; padding: 0.5rem; cursor: pointer;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Getting Started Section -->
            <div
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Getting Started</h2>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.5rem; text-align: center;">
                        <div
                            style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">1. Create
                            Account</h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem;">Register for an account and
                            wait for API authorization</p>
                        <a href="{{ route('register') }}"
                            style="display: inline-block; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s ease;">Register
                            Now</a>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.5rem; text-align: center;">
                        <div
                            style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                        </div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">2. Generate
                            API Key</h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem;">Create your API key from the
                            dashboard</p>
                        <a href="{{ route('api-keys.index') }}"
                            style="display: inline-block; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s ease;">Manage
                            Keys</a>
                    </div>

                    <div style="background: #f9fafb; border-radius: 0.75rem; padding: 1.5rem; text-align: center;">
                        <div
                            style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 9999px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <svg style="width: 1.5rem; height: 1.5rem; color: white;" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem;">3. Start
                            Integrating</h3>
                        <p style="color: #4b5563; font-size: 0.875rem; margin-bottom: 1rem;">Use our code examples to start
                            creating orders</p>
                        <a href="#examples"
                            style="display: inline-block; background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; text-decoration: none; font-weight: 500; transition: all 0.2s ease;">View
                            Examples</a>
                    </div>
                </div>
            </div>

            <!-- Support Section -->
            <div
                style="background: white; border-radius: 1rem; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                    <div
                        style="width: 2rem; height: 2rem; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 1rem; height: 1rem; color: white;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h2 style="font-size: 1.25rem; font-weight: 600; color: #1f2937; margin: 0;">Support & Resources</h2>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Need Help?</h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #3b82f6;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <div>
                                    <div style="font-size: 0.875rem; font-weight: 600; color: #4b5563;">Email</div>
                                    <div style="font-size: 0.875rem; color: #3b82f6;">reaganmukabana@gmail.com</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #10b981;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <div>
                                    <div style="font-size: 0.875rem; font-weight: 600; color: #4b5563;">Phone</div>
                                    <div style="font-size: 0.875rem; color: #10b981;">+254706378245</div>
                                </div>
                            </div>

                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #f59e0b;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <div style="font-size: 0.875rem; font-weight: 600; color: #4b5563;">Hours</div>
                                    <div style="font-size: 0.875rem; color: #f59e0b;">Monday-Friday, 8AM-6PM EAT</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 style="font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 1rem;">Useful Links
                        </h3>
                        <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                            <a href="{{ route('api-keys.index') }}"
                                style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #4b5563; transition: color 0.2s ease;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #f59e0b;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                <span style="font-size: 0.875rem;">API Key Management</span>
                            </a>

                            <a href="{{ route('orders.index') }}"
                                style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #4b5563; transition: color 0.2s ease;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #3b82f6;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <span style="font-size: 0.875rem;">My Orders</span>
                            </a>

                            <a href="{{ url('contact') }}"
                                style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #4b5563; transition: color 0.2s ease;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #10b981;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span style="font-size: 0.875rem;">Contact Support</span>
                            </a>

                            <a href="{{ url('faq') }}"
                                style="display: flex; align-items: center; gap: 0.75rem; text-decoration: none; color: #4b5563; transition: color 0.2s ease;">
                                <svg style="width: 1.25rem; height: 1.25rem; color: #8b5cf6;" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span style="font-size: 0.875rem;">FAQ</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Highlight current section in navigation
        window.addEventListener('scroll', function() {
            const sections = document.querySelectorAll('[id]');
            const navLinks = document.querySelectorAll('.nav-pills .nav-link');

            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                if (scrollY >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });

        // Tab functionality for code examples
        function showTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('[id$="-tab-content"]').forEach(tab => {
                tab.style.display = 'none';
            });

            // Show selected tab content
            document.getElementById(tabId + '-tab-content').style.display = 'block';

            // Update active tab button
            document.querySelectorAll('#examples button').forEach(button => {
                button.style.background = '#f3f4f6';
                button.style.color = '#4b5563';
            });

            document.getElementById(tabId + '-tab').style.background = '#3b82f6';
            document.getElementById(tabId + '-tab').style.color = 'white';
        }

        // Copy to clipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                // Show a temporary tooltip or notification
                const tooltip = document.createElement('div');
                tooltip.textContent = 'Copied!';
                tooltip.style.position = 'fixed';
                tooltip.style.bottom = '20px';
                tooltip.style.right = '20px';
                tooltip.style.background = '#10b981';
                tooltip.style.color = 'white';
                tooltip.style.padding = '0.5rem 1rem';
                tooltip.style.borderRadius = '0.25rem';
                tooltip.style.zIndex = '1000';
                document.body.appendChild(tooltip);

                setTimeout(() => {
                    document.body.removeChild(tooltip);
                }, 2000);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        }
    </script>
@endsection
