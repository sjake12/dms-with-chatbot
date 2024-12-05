import React, { useState, useEffect, useRef } from 'react';
import axios from 'axios';
import { MessageCircle, X, Send } from 'lucide-react';

const RasaChatBubble = () => {
    const [isOpen, setIsOpen] = useState(false);
    const [message, setMessage] = useState('');
    const [chatHistory, setChatHistory] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const messagesEndRef = useRef(null);

    // Scroll to bottom when messages change
    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    useEffect(() => {
        scrollToBottom();
    }, [chatHistory]);

    // Fetch initial context data when chat opens
    const fetchChatContext = async () => {
        try {
            const response = await axios.get('/chatbot/data');
            // Optionally add initial context message
            setChatHistory(prev => [
                ...prev,
                {
                    type: 'bot',
                    content: 'Hello! I\'m ready to help you.'
                }
            ]);
        } catch (error) {
            console.error('Failed to fetch chat context:', error);
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setMessage(''); // Clear input
        if (!message.trim()) return;

        // Add user message to chat history
        const userMessage = { type: 'user', content: message };
        setChatHistory(prev => [...prev, userMessage]);
        setIsLoading(true);

        try {
            // Send message to Rasa via Laravel backend
            const response = await axios.post('/chatbot/message', {
                message
            });

            // Add console.log to see the response structure
            console.log('Rasa response:', response.data);

            // Process Rasa responses
            const botResponses = response.data;
            const botMessages = botResponses.map(resp => ({
                type: 'bot',
                content: resp.text || 'I\'m not sure how to respond.'
            }));

            // Add bot messages to chat history
            setChatHistory(prev => [...prev, ...botMessages]);
            setMessage(''); // Clear input
        } catch (error) {
            console.error('Chat error:', error);
            setChatHistory(prev => [...prev, {
                type: 'bot',
                content: 'Sorry, there was an error processing your message.'
            }]);
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <div className="fixed bottom-10 right-10 z-50">
            {!isOpen ? (
                <button
                    onClick={() => {
                        setIsOpen(true);
                        fetchChatContext();
                    }}
                    className="bg-blue-500 hover:bg-blue-600 text-white rounded-full p-4 shadow-lg transition-all duration-200"
                >
                    <MessageCircle className="w-6 h-6" />
                </button>
            ) : (
                <div className="bg-white rounded-lg shadow-xl w-96 max-h-[500px] flex flex-col">
                    {/* Header */}
                    <div className="bg-blue-500 text-white p-4 rounded-t-lg flex justify-between items-center">
                        <h3 className="font-semibold">AI Assistant</h3>
                        <button
                            onClick={() => setIsOpen(false)}
                            className="hover:bg-blue-600 rounded-full p-1"
                        >
                            <X className="w-5 h-5" />
                        </button>
                    </div>

                    {/* Chat Messages */}
                    <div className="flex-1 overflow-y-auto p-4 space-y-4 max-h-96">
                        {chatHistory.map((msg, index) => (
                            <div
                                key={index}
                                className={`flex ${msg.type === 'user' ? 'justify-end' : 'justify-start'}`}
                            >
                                <div
                                    className={`max-w-[80%] rounded-lg p-3 ${
                                        msg.type === 'user'
                                            ? 'bg-blue-500 text-white'
                                            : 'bg-gray-100 text-gray-800'
                                    }`}
                                >
                                    {msg.content}
                                </div>
                            </div>
                        ))}
                        {isLoading && (
                            <div className="flex justify-start">
                                <div className="bg-gray-100 rounded-lg p-3 max-w-[80%]">
                                    <div className="flex space-x-2">
                                        <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                                        <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce delay-100"></div>
                                        <div className="w-2 h-2 bg-gray-400 rounded-full animate-bounce delay-200"></div>
                                    </div>
                                </div>
                            </div>
                        )}
                        <div ref={messagesEndRef} />
                    </div>

                    {/* Input Form */}
                    <form onSubmit={handleSubmit} className="p-4 border-t">
                        <div className="flex space-x-2">
                            <input
                                type="text"
                                value={message}
                                onChange={(e) => setMessage(e.target.value)}
                                placeholder="Type your message..."
                                className="flex-1 border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            />
                            <button
                                type="submit"
                                disabled={isLoading || !message.trim()}
                                className="bg-blue-500 text-white rounded-lg px-4 py-2 hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <Send className="w-5 h-5" />
                            </button>
                        </div>
                    </form>
                </div>
            )}
        </div>
    );
};

export default RasaChatBubble;
