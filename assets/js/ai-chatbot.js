// Woolify AI Chatbot (Gemini API powered)
// Modular, clean, and easy to maintain
// Author: Woolify Team

// ---- CONFIGURATION ----
const GEMINI_API_KEY = 'AIzaSyCOdJgtaGHkcs6iCwo8xEXhL9A3ogo24ZQ'; // <-- Replace with your Gemini API key
const GEMINI_API_URL = 'https://generativelanguage.googleapis.com/v1/models/gemini-1.5-flash:generateContent?key=' + GEMINI_API_KEY;
const SYSTEM_PROMPT = `You are an expert wool grader specialized in sustainable farming. Analyze the uploaded wool photo. Based on the fiber texture, cleanliness, and color, predict:\n1. Wool Grade (A / B / C).\n2. Type of Wool (e.g., Merino, Alpaca, etc.).\n3. Estimated Price (₹/kg) for the Indian market (current average market rates).\nKeep the response professional, brief, and farmer-friendly.`;

// ---- UI ELEMENTS ----
let chatOpen = false;

// Create chat window container
defineChatbotUI();

function defineChatbotUI() {
    // Only add if not already present
    if (document.getElementById('woolify-chatbot-backdrop')) return;

    // Backdrop
    const backdrop = document.createElement('div');
    backdrop.id = 'woolify-chatbot-backdrop';
    backdrop.className = 'fixed inset-0 z-50 bg-black/40 flex items-center justify-center transition-opacity duration-300 opacity-0 pointer-events-none';
    backdrop.style.display = 'none';
    document.body.appendChild(backdrop);

    // Chat Modal
    const chatDiv = document.createElement('div');
    chatDiv.id = 'woolify-chatbot';
    chatDiv.className = 'relative w-[90vw] max-w-2xl h-[90vh] max-h-[700px] bg-white border border-primary-200 rounded-2xl shadow-2xl flex flex-col transition-all duration-300 scale-95 opacity-0 translate-y-8';
    chatDiv.innerHTML = `
        <div class="flex items-center justify-between px-6 py-4 border-b border-primary-100 bg-primary-50">
            <span class="font-semibold text-primary-700 text-lg">Woolify AI Chat</span>
            <button id="woolify-chatbot-close" class="text-gray-400 hover:text-primary-600 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div id="woolify-chatbot-messages" class="flex-1 px-6 py-4 space-y-3 overflow-y-auto bg-white" style="max-height: calc(90vh - 120px);"></div>
        <form id="woolify-chatbot-form" class="flex items-center gap-2 px-6 py-4 border-t border-primary-100 bg-white">
            <input type="text" id="woolify-chatbot-input" class="flex-1 px-4 py-3 rounded-lg border border-primary-100 focus:ring-2 focus:ring-primary-200 focus:outline-none text-base bg-white" placeholder="Ask about wool..." autocomplete="off" />
            <label for="woolify-chatbot-image" class="cursor-pointer text-primary-600 hover:text-primary-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553 2.276A2 2 0 0121 14.118V17a2 2 0 01-2 2H5a2 2 0 01-2-2v-2.882a2 2 0 01.447-1.342L8 10m7-4V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v1m0 0a2 2 0 00-2 2v2a2 2 0 002 2h6a2 2 0 002-2v-2a2 2 0 00-2-2z"/></svg>
                <input type="file" id="woolify-chatbot-image" accept="image/*" class="hidden" />
            </label>
            <button type="submit" class="bg-primary-600 text-white px-4 py-3 rounded-lg hover:bg-primary-700 focus:outline-none text-base">Send</button>
        </form>
    `;
    backdrop.appendChild(chatDiv);

    // Event listeners
    document.querySelector('.fixed.bottom-8.right-8.z-50').addEventListener('click', toggleChatbot);
    backdrop.addEventListener('click', (e) => { if (e.target === backdrop) toggleChatbot(); });
    chatDiv.querySelector('#woolify-chatbot-close').addEventListener('click', toggleChatbot);
    chatDiv.querySelector('#woolify-chatbot-form').addEventListener('submit', handleTextSubmit);
    chatDiv.querySelector('#woolify-chatbot-image').addEventListener('change', handleImageUpload);
}

function toggleChatbot() {
    chatOpen = !chatOpen;
    const backdrop = document.getElementById('woolify-chatbot-backdrop');
    const chatDiv = document.getElementById('woolify-chatbot');
    if (chatOpen) {
        backdrop.style.display = 'flex';
        setTimeout(() => {
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            backdrop.classList.add('opacity-100');
            chatDiv.classList.remove('scale-95', 'opacity-0', 'translate-y-8');
            chatDiv.classList.add('scale-100', 'opacity-100', 'translate-y-0');
        }, 10);
    } else {
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0', 'pointer-events-none');
        chatDiv.classList.remove('scale-100', 'opacity-100', 'translate-y-0');
        chatDiv.classList.add('scale-95', 'opacity-0', 'translate-y-8');
        setTimeout(() => {
            backdrop.style.display = 'none';
        }, 300);
    }
}

function appendMessage(content, from = 'user', isImage = false) {
    const msgDiv = document.createElement('div');
    msgDiv.className = `flex ${from === 'user' ? 'justify-end' : 'justify-start'}`;
    msgDiv.innerHTML = `
        <div class="max-w-[75%] px-4 py-2 rounded-xl shadow-sm border text-sm ${from === 'user' ? 'bg-primary-50 text-primary-900 border-primary-100' : 'bg-white text-gray-800 border-primary-100'}">
            ${isImage ? `<img src="${content}" alt="Uploaded" class="w-32 h-auto rounded mb-1" />` : ''}
            ${!isImage ? content : ''}
        </div>
    `;
    document.getElementById('woolify-chatbot-messages').appendChild(msgDiv);
    scrollChatToBottom();
}

function scrollChatToBottom() {
    const msgBox = document.getElementById('woolify-chatbot-messages');
    msgBox.scrollTop = msgBox.scrollHeight;
}

function handleTextSubmit(e) {
    e.preventDefault();
    const input = document.getElementById('woolify-chatbot-input');
    const text = input.value.trim();
    if (!text) return;
    appendMessage(text, 'user');
    input.value = '';
    showUploading(true);
    sendToGemini({ text });
}

function handleImageUpload(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        appendMessage(ev.target.result, 'user', true);
        showUploading(true);
        sendToGemini({ image: ev.target.result });
    };
    reader.readAsDataURL(file);
}

function showUploading(show) {
    let uploading = document.getElementById('woolify-chatbot-uploading');
    if (show) {
        if (!uploading) {
            uploading = document.createElement('div');
            uploading.id = 'woolify-chatbot-uploading';
            uploading.className = 'flex items-center space-x-2 px-4 py-2';
            uploading.innerHTML = `<svg class="animate-spin w-5 h-5 text-primary-600" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path></svg><span class="text-primary-600 text-sm">Uploading...</span>`;
            document.getElementById('woolify-chatbot-messages').appendChild(uploading);
            scrollChatToBottom();
        }
    } else {
        if (uploading) uploading.remove();
    }
}

// ---- Custom Prompt Handling ----
function isIdentityQuestion(text) {
    const patterns = [
        /who\s+are\s+you/i,
        /what\s+are\s+you/i,
        /your\s+name/i,
        /are\s+you\s+an\s+ai/i,
        /about\s+you/i,
        /what\s+can\s+you\s+do/i,
        /who\s+is\s+this/i
    ];
    return patterns.some((re) => re.test(text));
}

function getIdentityResponse() {
    return (
        "I'm Woolify's exclusive AI chat assistant, specially designed for farmers and wool producers. " +
        "I can answer your questions about wool quality, sustainable farming, pricing, and more. " +
        "For the most accurate wool grading and price estimate, please upload a clear photo of your wool!"
    );
}

function getTextResponsePrompt(userText) {
    return (
        `You are an expert wool advisor for Indian farmers. Answer the user's question below in a professional, friendly, and concise way. ` +
        `If the question is about wool quality, remind the user to upload a wool photo for a more accurate assessment. ` +
        `Question: "${userText}"\n\n` +
        `End your answer with: 'For a more accurate wool grade and price, please upload a clear photo of your wool.'`
    );
}

async function sendToGemini({ text, image }) {
    let contents = [];
    // 1. Identity questions (who are you, what are you, etc.)
    if (text && isIdentityQuestion(text)) {
        appendMessage(getIdentityResponse(), 'ai');
        showUploading(false);
        return;
    }
    if (image) {
        // Image + prompt
        contents = [
            {
                role: "user",
                parts: [
                    { text: SYSTEM_PROMPT },
                    { inline_data: { mime_type: "image/jpeg", data: image.split(',')[1] } }
                ]
            }
        ];
    } else if (text) {
        // Text only: use a special prompt for wool Q&A and encourage photo upload
        contents = [
            {
                role: "user",
                parts: [
                    { text: getTextResponsePrompt(text) }
                ]
            }
        ];
    }
    try {
        const res = await fetch(GEMINI_API_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ contents })
        });
        const data = await res.json();
        showUploading(false);
        let reply = data.candidates?.[0]?.content?.parts?.[0]?.text || 'Sorry, I could not process your request.';
        appendMessage(reply, 'ai');
    } catch (err) {
        showUploading(false);
        appendMessage('Error contacting AI service. Please try again.', 'ai');
    }
}

// ---- Responsive: Hide on mobile keyboard open ----
window.addEventListener('resize', () => {
    const chatDiv = document.getElementById('woolify-chatbot');
    if (!chatDiv) return;
    if (window.innerHeight < 400) chatDiv.style.display = 'none';
    else if (chatOpen) chatDiv.style.display = 'flex';
});

// ---- Exported for future modularity ----
window.WoolifyAIChatbot = {
    open: () => { if (!chatOpen) toggleChatbot(); },
    close: () => { if (chatOpen) toggleChatbot(); },
    send: (msg) => { appendMessage(msg, 'user'); sendToGemini({ text: msg }); }
}; 