<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Mini X</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #e7e9ea;
            background: #000000;
            font-family: Arial, sans-serif;
        }

        header {
            position: sticky;
            top: 0;
            z-index: 10;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 25px;
            background: #000000;
            border-bottom: 1px solid #2f3336;
        }

        header h1 {
            margin: 0;
            font-size: 25px;
        }

        .page {
            display: grid;
            grid-template-columns: minmax(0, 650px) 340px;
            gap: 25px;
            max-width: 1050px;
            margin: auto;
        }

        .timeline {
            border-right: 1px solid #2f3336;
            border-left: 1px solid #2f3336;
        }

        .composer,
        .message {
            padding: 20px;
            border-bottom: 1px solid #2f3336;
        }

        textarea {
            width: 100%;
            min-height: 100px;
            padding: 14px;
            resize: vertical;
            color: #ffffff;
            background: #000000;
            border: 1px solid #536471;
            border-radius: 10px;
            font-size: 17px;
        }

        textarea:focus {
            border-color: #1d9bf0;
            outline: none;
        }

        .post-row {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        button {
            padding: 10px 18px;
            color: #ffffff;
            background: #1d9bf0;
            border: none;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
        }

        .logout-button {
            color: #000000;
            background: #ffffff;
        }

        .message-name {
            font-weight: bold;
        }

        .message-email,
        .message-time {
            color: #71767b;
            font-size: 13px;
        }

        .message-text {
            margin-top: 12px;
            line-height: 1.5;
            white-space: pre-wrap;
            overflow-wrap: anywhere;
        }

        aside {
            padding: 20px 0;
        }

        .side-card {
            margin-bottom: 20px;
            padding: 18px;
            background: #16181c;
            border-radius: 16px;
        }

        .side-card h2 {
            margin-top: 0;
            font-size: 20px;
        }

        .user-row {
            padding: 12px 0;
            border-bottom: 1px solid #2f3336;
        }

        .user-row:last-child {
            border-bottom: none;
        }

        .user-name {
            margin-bottom: 4px;
            font-weight: bold;
        }

        .user-email {
            margin-bottom: 9px;
            color: #71767b;
            font-size: 13px;
        }

        .small-button {
            padding: 7px 13px;
            font-size: 13px;
        }

        .success,
        .error {
            margin: 15px;
            padding: 12px;
            border-radius: 8px;
        }

        .success {
            color: #00ba7c;
            border: 1px solid #00ba7c;
        }

        .error {
            color: #ff6b6b;
            border: 1px solid #ff6b6b;
        }

        .empty {
            color: #71767b;
            font-size: 14px;
        }

        @media (max-width: 850px) {
            .page {
                display: block;
            }

            .timeline {
                border-right: none;
                border-left: none;
            }

            aside {
                padding: 20px;
            }
        }

            .people-search {
                margin-bottom: 18px;
            }

            .people-search input {
                width: 100%;
                padding: 11px 13px;
                color: #ffffff;
                background: #000000;
                border: 1px solid #536471;
                border-radius: 8px;
                font-size: 14px;
            }

            .people-search input:focus {
                border-color: #1d9bf0;
                outline: none;
            }

            .search-actions {
                display: flex;
                gap: 8px;
                margin-top: 8px;
            }

            .search-button {
                padding: 8px 14px;
                font-size: 13px;
            }

            .clear-link {
                display: inline-flex;
                align-items: center;
                padding: 8px 14px;
                color: #ffffff;
                border: 1px solid #536471;
                border-radius: 50px;
                font-size: 13px;
                text-decoration: none;
            }

            .request-actions {
                display: flex;
                gap: 8px;
            }

            .reject-button {
                background: #f4212e;
            }


            .comments-section {
                margin-top: 18px;
                padding-top: 15px;
                border-top: 1px solid #2f3336;
            }

            .comments-heading {
                margin-bottom: 12px;
                color: #71767b;
                font-size: 14px;
                font-weight: bold;
            }

            .comment {
                margin-bottom: 10px;
                padding: 10px 12px;
                background: #16181c;
                border-radius: 10px;
            }

            .comment-header {
                display: flex;
                justify-content: space-between;
                gap: 10px;
                margin-bottom: 5px;
                font-size: 14px;
            }

            .comment-time {
                color: #71767b;
                font-size: 12px;
            }

            .comment-text {
                line-height: 1.4;
                overflow-wrap: anywhere;
            }

            .comment-form {
                display: flex;
                gap: 8px;
                margin-top: 12px;
            }

            .comment-form input {
                flex: 1;
                min-width: 0;
                padding: 10px 12px;
                color: #ffffff;
                background: #000000;
                border: 1px solid #536471;
                border-radius: 50px;
            }

            .comment-form input:focus {
                border-color: #1d9bf0;
                outline: none;
            }

            .comment-button {
                padding: 9px 14px;
                font-size: 13px;
            }

            .reaction-section {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-top: 15px;
            }

            .reaction-section form {
                margin: 0;
            }

            .reaction-button {
                padding: 8px 13px;
                color: #71767b;
                background: transparent;
                border: 1px solid #2f3336;
                border-radius: 50px;
                font-size: 13px;
                cursor: pointer;
            }

            .reaction-button:hover {
                color: #1d9bf0;
                border-color: #1d9bf0;
            }

            .reaction-button.reaction-active {
                color: #ffffff;
                background: #1d9bf0;
                border-color: #1d9bf0;
            }

    </style>
</head>

<body>
    <header>
        <div>
            <h1>Mini X</h1>
            <small>Welcome, {{ $currentUser->name }}</small>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="logout-button">
                Logout
            </button>
        </form>
    </header>

    <div class="page">
        <main class="timeline">
            @if (session('success'))
                <div class="success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <section class="composer">
                <form
                    method="POST"
                    action="{{ route('messages.store') }}"
                >
                    @csrf

                    <textarea
                        name="message"
                        maxlength="2000"
                        placeholder="What is happening?"
                        required
                    >{{ old('message') }}</textarea>

                    <div class="post-row">
                        <button type="submit">
                            Post
                        </button>
                    </div>
                </form>
            </section>

            <section>
                @forelse ($messages as $message)
                    <article class="message">
                        <div>
                            <span class="message-name">
                                {{ $message->user->name }}
                            </span>

                            <span class="message-email">
                                {{ $message->user->email }}
                            </span>
                        </div>

                        <div class="message-time">
                            {{ date('d M Y, h:i A', $message->time) }}
                        </div>

                        <div class="message-text">{{ $message->message }}</div>
                            <div class="reaction-section">
                                <form
                                    method="POST"
                                    action="{{ route('messages.reaction', $message) }}"
                                >
                                    @csrf

                                    <input
                                        type="hidden"
                                        name="reaction"
                                        value="like"
                                    >

                                    <button
                                        type="submit"
                                        class="reaction-button
                                            {{
                                                $message->reactions->first()?->reaction === 'like'
                                                    ? 'reaction-active'
                                                    : ''
                                            }}"
                                    >
                                        👍 Like {{ $message->likes_count }}
                                    </button>
                                </form>

                                <form
                                    method="POST"
                                    action="{{ route('messages.reaction', $message) }}"
                                >
                                    @csrf

                                    <input
                                        type="hidden"
                                        name="reaction"
                                        value="dislike"
                                    >

                                    <button
                                        type="submit"
                                        class="reaction-button
                                            {{
                                                $message->reactions->first()?->reaction === 'dislike'
                                                    ? 'reaction-active'
                                                    : ''
                                            }}"
                                    >
                                        👎 Dislike {{ $message->dislikes_count }}
                                    </button>
                                </form>
                            </div>


                        <div class="comments-section">
                            <div class="comments-heading">
                                Comments ({{ $message->comments->count() }})
                            </div>

                            @foreach ($message->comments as $comment)
                                <div class="comment">
                                    <div class="comment-header">
                                        <strong>{{ $comment->user->name }}</strong>

                                        <span class="comment-time">
                                            {{ date('d M Y, h:i A', $comment->time) }}
                                        </span>
                                    </div>

                                    <div class="comment-text">
                                        {{ $comment->comment }}
                                    </div>
                                </div>
                            @endforeach

                            <form
                                method="POST"
                                action="{{ route('comments.store', $message) }}"
                                class="comment-form"
                            >
                                @csrf

                                <input
                                    type="text"
                                    name="comment"
                                    maxlength="1000"
                                    placeholder="Write a comment..."
                                    required
                                >

                                <button type="submit" class="comment-button">
                                    Comment
                                </button>
                            </form>
                        </div>
                    </article>
                @empty
                    <div class="message empty">
                        No messages have been posted yet.
                    </div>
                @endforelse
            </section>
        </main>

        <aside>
            <section class="side-card">
                <h2>Friend requests</h2>

                @forelse ($pendingRequests as $friendRequest)
                    <div class="user-row">
                        <div class="user-name">
                            {{ $friendRequest->sender->name }}
                        </div>

                        <div class="user-email">
                            {{ $friendRequest->sender->email }}
                        </div>

                        <div class="request-actions">
                            <form
                                method="POST"
                                action="{{ route(
                                    'contacts.accept',
                                    $friendRequest
                                ) }}"
                            >
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="small-button">
                                    Accept
                                </button>
                            </form>

                            <form
                                method="POST"
                                action="{{ route(
                                    'contacts.reject',
                                    $friendRequest
                                ) }}"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="small-button reject-button"
                                >
                                    Reject
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="empty">
                        No pending requests.
                    </div>
                @endforelse
            </section>

            <section class="side-card">
                <form
                    method="GET"
                    action="{{ route('dashboard') }}"
                    class="people-search"
                >
                    <input
                        type="text"
                        name="phone"
                        value="{{ $phoneSearch }}"
                        placeholder="Search by phone number"
                    >

                    <div class="search-actions">
                        <button
                            type="submit"
                            class="search-button"
                        >
                            Search
                        </button>

                        @if ($phoneSearch !== '')
                            <a
                                href="{{ route('dashboard') }}"
                                class="clear-link"
                            >
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                <h2>People</h2>

                @forelse ($availableUsers as $user)
                    <div class="user-row">
                        <div class="user-name">
                            {{ $user->name }}
                        </div>

                        <div class="user-email">
                            {{ $user->email }}
                        </div>

                        <form
                            method="POST"
                            action="{{ route('contacts.send') }}"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="friend_id"
                                value="{{ $user->id }}"
                            >

                            <button type="submit" class="small-button">
                                Add friend
                            </button>
                        </form>
                    </div>
                @empty
                    <div class="empty">
                        No new users available.
                    </div>
                @endforelse
            </section>

            <section class="side-card">
                <h2>Sent requests</h2>

                @forelse ($sentRequests as $request)
                    <div class="user-row">
                        <div class="user-name">
                            {{ $request->receiver->name }}
                        </div>

                        <div class="user-email">
                            Waiting for acceptance
                        </div>
                    </div>
                @empty
                    <div class="empty">
                        No sent requests.
                    </div>
                @endforelse
            </section>

            <section class="side-card">
                <h2>Friends</h2>

                @forelse ($friends as $friend)
                    <div class="user-row">
                        <div class="user-name">
                            {{ $friend->name }}
                        </div>

                        <div class="user-email">
                            {{ $friend->email }}
                        </div>
                    </div>
                @empty
                    <div class="empty">
                        You have no friends yet.
                    </div>
                @endforelse
            </section>
        </aside>
    </div>
</body>
</html>