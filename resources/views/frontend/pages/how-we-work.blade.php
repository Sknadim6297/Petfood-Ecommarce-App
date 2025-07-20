@extends('frontend.layouts.layout')

@section('title', 'How We Work')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>How We Work</h1>
                <p>Our process for providing excellent pet care services.</p>
            </div>
            
            <div class="process-steps">
                <div class="row">
                    <div class="col-md-3 text-center mb-4">
                        <div class="step-card">
                            <div class="step-number">1</div>
                            <h4>Consultation</h4>
                            <p>We start with understanding your pet's needs</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center mb-4">
                        <div class="step-card">
                            <div class="step-number">2</div>
                            <h4>Assessment</h4>
                            <p>Complete health and behavior assessment</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center mb-4">
                        <div class="step-card">
                            <div class="step-number">3</div>
                            <h4>Service</h4>
                            <p>Providing the best care and treatment</p>
                        </div>
                    </div>
                    <div class="col-md-3 text-center mb-4">
                        <div class="step-card">
                            <div class="step-number">4</div>
                            <h4>Follow-up</h4>
                            <p>Ongoing support and care monitoring</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
